<?php

namespace App\Http\Controllers\Quizes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quizes\Quiz\StoreRequest;
use App\Http\Requests\Quizes\Quiz\UpdateRequest;
use App\Http\Resources\Quizes\Quiz\QuizListResource;
use App\Http\Resources\Quizes\Quiz\QuizShowResource;
use App\Models\Quizes\Quiz;
use App\Services\Quizes\Quiz\CreateQuiz;
use App\Services\Quizes\Quiz\DestroyQuiz;
use App\Services\Quizes\Quiz\UpdateQuiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $quizes = Quiz::latest()->get();

            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => QuizListResource::collection($quizes),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(), 
                'data' => null, 400,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $quiz = app(CreateQuiz::class)->execute($request->all());

            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => new QuizShowResource($quiz),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(), 
                'data' => null, 400,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $quiz = Quiz::findOrFail($id);

            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => new QuizShowResource($quiz),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(), 
                'data' => null, 400,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $quiz = app(UpdateQuiz::class)->execute($request->all(), $id);

            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => new QuizShowResource($quiz),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(), 
                'data' => null, 400,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $quiz = app(DestroyQuiz::class)->execute($id);

            return response()->json([
                'status' => true,
                'errors' => null,
                'data' => $quiz,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(), 
                'data' => null, 400,
            ]);
        }
    }
}
