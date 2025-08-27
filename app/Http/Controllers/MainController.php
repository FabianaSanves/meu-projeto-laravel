<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
 
    public function index()
    {
       // load user's notes
       $id = session('user.id');
       $notes = User::find($id)
                    ->notes()
                    ->whereNull('deleted_at')
                    ->get()
                    ->toArray();

       // show home view
       return view('home', ['notes' => $notes]);
    }

    // Exibe o formulário de registro
    public function showRegisterForm()
    {
        return view('register');
    }

    // Processa o cadastro do usuário
    public function registerUser(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:100|confirmed'
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.'
        ]);

        // Cria o usuário
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Redireciona para login com mensagem
        return redirect()->route('login')->with('success', 'Usuário criado com sucesso! Faça login.');
    }

        public function newNote() 
    {
       // show new note view
       return view('new_note');
    }

    public function newNoteSubmit(Request $request) 
    {
        // validate request

            $request->validate(
                [
                    'text_title' => 'required |min:3|max:200',
                    'text_note' => 'required |min:3|max:3000'
                ],
                //error messages
                [
                    'text_title.required' => 'O título é obrigatório.',
                    'text_title.min' => 'O título deve ter no mínimo :min caracteres',
                    'text_title.max' => 'O título deve ter no máximo :max caracteres',
                    'text_note.required' => 'A descrição é obrigatória.',
                    'text_note.min' => 'A descrição deve ter no mínimo :min caracteres',
                    'text_note.max' => 'A descrição deve ter no máximo :max caracteres'
                ]
            
            );

        // get user id
        $id = session('user.id');

        // create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route ('home');
    }

    public function editNote($id) 
    {
        $id = Operations::decryptId($id);

        if($id == null){
            return redirect()->route('home');
        }
        
        // load note
        $note = Note::find($id);

        //show edit note view
        return view('edit_note', ['note' => $note]);

  
    }

        public function editNoteSubmit(Request $request) 
        {
            //validade request
            $request->validate(
                [
                    'text_title' => 'required |min:3|max:200',
                    'text_note' => 'required |min:3|max:3000'
                ],
                //error messages
                [
                    'text_title.required' => 'O título é obrigatório.',
                    'text_title.min' => 'O título deve ter no mínimo :min caracteres',
                    'text_title.max' => 'O título deve ter no máximo :max caracteres',
                    'text_note.required' => 'A descrição é obrigatória.',
                    'text_note.min' => 'A descrição deve ter no mínimo :min caracteres',
                    'text_note.max' => 'A descrição deve ter no máximo :max caracteres'
                ]
            
            );            
            
            // check if note_id is exists
            if ($request->note_id == null){
                return redirect()->route('home');
            }

            //decrypt note_id
            $id = Operations::decryptId($request->note_id);

                    if($id == null){
            return redirect()->route('home');
        }

            //load note
            $note = Note::find($id);

            //update note
            $note->title = $request->text_title;
            $note->text = $request->text_note;
            $note->save();

            //redirect to home
            return redirect()->route('home');
        }


        public function deleteNote($id) 
    {
        $id = Operations::decryptId($id);

                if($id == null){
            return redirect()->route('home');
        }
       
        // load note
        $note = Note::find($id);

        // show delete note confirmation 
        return view('delete_note', ['note' => $note]);
  
    }

        public function deleteNoteConfirm($id) 
        {
            //check if $id is encrypted
            $id = Operations::decryptId($id);

                    if($id == null){
            return redirect()->route('home');
        }

            //load note
            $note = Note::find($id);

            //1. hard delete (sai do bando de dados)
            //$note->delete();

            //2. soft delete (fica no bando de dados)
            //$note->deleted_at = date('Y-m-d H:i:s');
            //$note->save();

            //3. soft delete (propriedade no model)
            $note->delete();

            //4. hard delete (propriedade no model)
            //$note->forceDelete();

            //redirect to home
            return redirect()->route('home');
        }

    
}
