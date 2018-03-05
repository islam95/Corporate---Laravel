<?php

namespace Corp\Http\Controllers;

use Corp\Models\Menu;
use Corp\Repositories\MenuRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Illuminate\Support\Facades\Mail;

class ContactController extends SiteController
{
    public function __construct(){
        parent::__construct(new MenuRepository(new Menu()));
        $this->sidebar = 'left';
        $this->template = env('THEME') . '.contact';
    }

    public function index(Request $request) {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => 'Field :attribute is required',
                'email'    => 'Field :attribute has to contain correct email address',
            ];

            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ]/*,$messages*/);

            $data = $request->all();

            $result = Mail::send(env('THEME').'.email', ['data' => $data], function ($m) use ($data) {
                $mail_admin = env('MAIL_ADMIN');
                $m->from($data['email'], $data['name']);
                $m->to($mail_admin, 'Mr. Admin')->subject('Question');
            });

            if($result) {
                return redirect()->route('contact')->with('status', 'Thank you! Email is sent');
            }

        }


        $this->title = 'Contact';

        $content = view(env('THEME').'.contact.main')->render();
        $this->vars = array_add($this->vars,'content',$content);

        $this->sidebar_left = view(env('THEME').'.contact.sidebar')->render();

        return $this->renderOutput();
    }

}
