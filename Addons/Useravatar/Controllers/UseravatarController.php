<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Users\Addons\Useravatar\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\AddonController;
use Kazist\KazistFactory;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */
class UseravatarController extends AddonController
{

    public function indexAction($show_inviter_link = false, $my_account_link = 'users.users.edit')
    {

        $factory = new KazistFactory();

        $data_arr['show_inviter_link'] = $show_inviter_link;
        $data_arr['my_account_link'] = $my_account_link;

        $notheme = $this->request->get('notheme');
        $useremail = $this->request->get('useremail');

        if ($useremail != '') {
            $user = $factory->getRecord('#__users_users', 'uu', array('email=:email'), array('email' => $useremail));

            $data_arr['user_id'] = $user->id;
        }

        $this->html = $this->render('Users:Addons:Useravatar:views:useravatar.twig', $data_arr);

        $response = $this->response($this->html);

        if ($notheme == '') {
            $response = $this->response($this->html);
        } else {

            http_response_code(200);

            header('Content-Type: application/json');

            echo json_encode(array('html' => $this->html));
            exit;
        }

        return $response;
    }

}
