<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TardisController extends Controller
{
    /**
     * [valida description]
     * @return [type] [description]
     */
    public function valida(Request $request)
    {

        $r = $request->all();


        if (!empty($r)) {
            $crypt = new Encrypter(md5(config('app.tardis_encrypt')), 'AES-256-CBC');
            $jsonUser = $crypt->decrypt($r['token']);

            $usuario = json_decode($jsonUser, true)['usuario'];
            $user = Usuario::where('cpf', $usuario['cpf'])->first();
            
            if (!$user) {
                return redirect('/');
            }

            Auth::login($user);
        } else {
            echo 'Sem request!';
        }

        return redirect()->route('dashboard');
    }

    /**
     * @param Illuminate\Http\Request $request
     *
     * @return \App\Http\Models\Usuario
     * @return \App\Http\Models\UsuarioAcessos
     * @throws \Exceptions
     *
     */
    public function updatePasswordTardis($cpf)
    {
        $usuario = Usuario::whereCpf($cpf)->first();

        if (! $usuario) {
            return false;
        }

        $tardis = new TardisApiService;
        $form = [
            'tardis_url'    => config('app.tardis_url') . "new-password/" . config('app.tardis_request'),
            'request'       => $tardis::crypt(config('app.tardis_encrypt'), ['cpf' => $cpf])
        ];

        return view('admin.update-password', compact('form'));
    }


    /**
     * @param integer $id
     *
     * @return \App\Http\Models\Usuario
     *
     */
    public function alteraStatusUsuario($id = null)
    {
        $user = Usuario::find($id);

        if (!$user) {
            return response()->json([
                'status'    => 'Falha',
                'message'   => 'Usuario não encontrado!'
            ]);
        }

        $add = $remove = [];
        $cpf = $user->cpf;

        if ($user->ativo == 1) :
            $user->ativo = 0; // INATIVO
            $remove = [$user->cpf];
        else :
            $user->ativo = 1; // ATIVO
            $add = [$user->cpf];
        endif;

        $user->save();

        $response = $this->modificaUserTardis($add, $remove);

        if (property_exists($response, 'add')) {
            foreach ($response->add as $r) {
                if ($r->$cpf->result != 'SUCCESS') {
                    throw new \Exception("Error: " . $r->msg);
                }
            }
        }

        if (property_exists($response, 'remove')) {
            foreach ($response->remove as $r) {
                if ($r->$cpf->result != 'SUCCESS') {
                    throw new \Exception("Error: " . $r->msg);
                }
            }
        }

        if (Auth::user()->id == $id) {
            Auth::logout();
        }

        return response()->json([
            'status'    => 'Ok',
            'message'   => 'Atualizado o status com sucesso'
        ]);
    }
    

    /**
     *  @param  [ array ] $add
     *  @param  [ array ] $remove
     *
     * Utilizado para atualizar ou desativar o acesso do usuário
     * na Tardis
     *
     */
    public function modificaUserTardis($add = [], $remove = [])
    {
        $body = ['add' => $add, 'remove' => $remove];
        
        $tardis = new TardisApiService;
        $ret = $tardis->access('PATCH', [config('app.tardis_request')], ['request' => $tardis::crypt(config('app.tardis_encrypt'), $body)
        ]);

        return $tardis::decrypt(config('app.tardis_encrypt'), json_decode($ret)->access->response);
    }
}
