<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D112012119_admin;
use Illuminate\Support\Facades\Validator;
class D112012119_adminController extends Controller
{
    //
     public function index()
    {

    	$posts= D112012119_admin::latest()->get();

    	return response()->json([

    		'success' => true,
    		'message' => 'List Semua Data Admin',
    		'data'	  => $posts	 		
    	], 200);
      
    }

 
    public function store(Request $request)
    {
 
         $validator = Validator::make($request->all(), [

             'name'       => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required'
           
        ],

        [
            
            'name.required' => 'Masukkan Name Admin Baru !',
            'email.required' => 'Masukkan Email Admin Baru !',
            'password.required' => 'Masukkan Password Admin Baru !'
       ]


       );

        if ($validator->fails()) {
            return response()->json([


                'success' => false,
                'message' => 'Silahkan Isi Yang Kosong',
                'data'    => $validator->errors()


              ],400);

        } else {


            $posts = D112012119_admin::create([

            'name'     => $request->name,
            'email'   => $request->email,
            'password'  => $request->password
          

            ]);


            if($posts) {

               return response()->json([

                'success' => true,
                'message' => 'Data Admin Berhasil Disimpan',
                'data'    => $posts  

                ],201);

            } 
            else {

              return response()->json([
                'success' => false,
                'message' => 'Data Admin Gagal Disimpan!',
                

                ], 401);


            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Client  $client
     * @return Response
     */
    public function show($id)
    {
          $posts= D112012119_admin::whereId($id)->first();

      if ($posts) {
      return response()->json([

        'success' => true,
        'message' => 'Detail Data Admin',
        'data'    => $posts     
      ], 200);

      } else {
          return response()->json([
                'success' => false,
                'message' => 'Detail Admin Tidak Ditemukan!',
                'data'    => ''
          ], 401);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Client  $client
     * @return Response
     */
    public function update(Request $request,$id)
    {
          $validator = Validator::make($request->all(), [
           // 'id'    => 'required',
            'name'       => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required'
           
        ],

           [
           // 'id.required' => 'Masukkan ID Admin !',
            'name.required' => 'Masukkan Name Admin Baru !',
            'email.required' => 'Masukkan Email Admin Baru !',
            'password.required' => 'Masukkan Password Admin Baru !'
         
           ]

       );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Yang Kosong',
                'data'    => $validator->errors()
            ], 400);
        } //else {
        $posts= D112012119_admin::whereId($id)->first();
           

            if ($posts) {

                $posts->update([
                'name'     => $request->input('name'),
                'email'   => $request->input('email'),
                'password'  => $request->input('password')
             
            ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Data Admin Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Admin Gagal Diupdate Karena ID Tersebut Tidak Ditemukan!',
                ], 401);
            }
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        
         $posts= D112012119_admin::whereId($id)->first();

       // $posts = D112012119_admin::findOrfail($id);
        

        if($posts) {
          //delete post
          $posts->delete();

          return response()->json([

           'success' => true,
           'message' => 'Data ID Admin Tersebut Berhasil Dihapus'
         

          ],200);

        } else {

        //data post not found
             return response()->json([

                'success' => false,
                'message' => 'ID Admin Tersebut Tidak Ditemukan!'

             ], 404);

        }

    }
}
