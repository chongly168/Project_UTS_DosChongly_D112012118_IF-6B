<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\D112012119_news;
use Illuminate\Support\Facades\Validator;

class D112012119_newsController extends Controller
{
    //
    public function index()
    {

    	$posts= D112012119_news::latest()->get();

    	return response()->json([

    		'success' => true,
    		'message' => 'List Semua Data Post',
    		'data'	  => $posts	 		
    	], 200);
      
    }

 
    public function store(Request $request)
    {
 
        $validator = Validator::make($request->all(), [

            'title' 	=> 'required',
            'img_url'   => 'required',
            'sub_desc'  => 'required',
            'desc'      => 'required'
           
        ],

        [
            'title.required' => 'Masukkan Title Post !',
            'img_url.required' => 'Masukkan Image Url Post !',
            'sub_desc.required' => 'Masukkan Sub Description Url Post !',
            'desc.required' => 'Masukkan Description Post !'
       ]


       );

        if ($validator->fails()) {
            return response()->json([


                'success' => false,
                'message' => 'Silahkan Isi Yang Kosong',
                'data'    => $validator->errors()


              ],400);

        } else {


            $posts = D112012119_news::create([

            'title'     => $request->title,
            'img_url'   => $request->img_url,
            'sub_desc'  => $request->sub_desc,
            'desc'      => $request->desc

            ]);


            if($posts) {

               return response()->json([

                'success' => true,
                'message' => 'Post Created',
                'data'    => $posts  

                ],201);

            } else {

              return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',

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
      $posts= D112012119_news::whereId($id)->first();

      if ($posts) {
    	return response()->json([

    		'success' => true,
    		'message' => 'Detail Data Post',
    		'data'	  => $posts	 		
    	], 200);

      } else {
          return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
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
            
            'title' 	  => 'required',
            'img_url'   => 'required',
            'sub_desc'  => 'required',
            'desc'      => 'required'
           
        ],

           [
           
            'title.required' => 'Masukkan Title Post !',
            'img_url.required' => 'Masukkan Image Url Post !',
            'sub_desc.required' => 'Masukkan Sub Description Url Post !',
            'desc.required' => 'Masukkan Description Post !'
           ]

       );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Yang Kosong',
                'data'    => $validator->errors()
            ], 400);
        } //else {
        $posts= D112012119_news::whereId($id)->first();

          

            if ($posts) {

               $posts->update([
                'title'     => $request->input('title'),
                'img_url'   => $request->input('img_url'),
                'sub_desc'  => $request->input('sub_desc'),
                'desc'      => $request->input('desc')
            ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data Post Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Post Gagal Diupdate Karena ID Tersebut Tidak Ditemukan!',
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
        $posts= D112012119_news::whereId($id)->first();

        //$posts = D112012119_news::findOrfail($id);
        

        if($posts) {
        	//delete post
        	$posts->delete();

      		return response()->json([

			     'success' => true,
    		   'message' => 'Data ID Post Tersebut Berhasil Dihapus'
    		 

      		],200);

      	} else {

      	//data post not found
      	     return response()->json([

      	        'success' => false,
    	          'message' => 'ID Post Tersebut Tidak Ditemukan!'

      	     ], 404);

        }


    }
}
