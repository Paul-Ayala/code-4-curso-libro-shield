<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Usuario extends BaseController{
    public function index() {
        if (!auth()->user()->can('users.detail')) {
            return redirect()->to('/');
        }
        $userModel = model('UserModel');
        echo view('dashboard/usuario/index',[
            'usuarios' => $userModel->find(),
        ]);
    }

    public function show($id) {
        // if (!auth()->user() || !auth()->user()->can('users.detail')) {
        //     echo -2;
        //     return;
        // }
        if (!auth()->user()->can('users.detail')) {
            echo -2;
            return;
        }
        // $userModel = model('UserModel');
        // $groupModel = model('groupModel');
        // $permissionModel = model('permissionModel');

        $authGroups = config('AuthGroups');
        $userModel = model('UserModel');

        // foreach ($authGroups->groups as $key => $gs) {
        //     var_dump($key);
        //     foreach ($gs as $key => $g) {
        //         # code...
        //     }
        // }

        // foreach ($authGroups->permissions as $key => $ps) {
        //     var_dump($key);
        // }

        echo view('dashboard/usuario/show',[
            'usuario' => $userModel->find($id),
            'groups' => $authGroups->groups,
            'permissions' => $authGroups->permissions,
            'matrix' => $authGroups->matrix
        ]);
    }
    public function permisos_manejar($usuarioId) {
        if (!auth()->user()->can('users.edit')) {
            echo -2;
            return;
        }
        $userModel = model('UserModel');
        $usuario = $userModel->find($usuarioId);
        $permiso = $this->request->getPost('permiso');
        //para ver en netword la impresión en la par6te del preview
        // return var_dump($permiso);

        if ($usuario->can($permiso)) {
            $usuario->removePermission($permiso);
            echo 0;
        }else {
            $usuario->addPermission($permiso);
            echo 1;
        }
    }

    public function grupos_manejar($usuarioId) {
        if (!auth()->user()->can('users.edit')) {
            echo -2;
            return;
        }
        $userModel = model('UserModel');
        $usuario = $userModel->find($usuarioId);
        $grupo = $this->request->getPost('grupo');

        if ($usuario->inGroup($grupo)) {
            $usuario->removeGroup($grupo);
            echo 0;
        }else {
            $usuario->addGroup($grupo);
            echo 1;
        }
    }
}
    
?>