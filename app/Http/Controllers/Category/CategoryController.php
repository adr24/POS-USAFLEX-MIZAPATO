<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\FullCategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // VALIDAR DATOS
        $category = $request->validated();
        $category['slug'] = $this->createSlug($category['name']);

        // GUARDAR EL REQUEST VALIDADO
        Category::create( $category );


        // RETORNAR MENSAJE DE GUARDADO 
        return response()->json([
            "message" => "La categoria fue registrada",
            "category" => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $term)
    {
        $category = Category::where('id', $term)
            ->orWhere('slug', $term)
            ->get();


        // VALIDAR DE QUE EXISTA LA CATEGORIA
        if( count($category) == 0 )
        {
            return response()->json([
                "message" => "No se encontro la categoria",
            ], 404);
        }

        return new FullCategoryResource($category[0]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if( !$category )
        {
            return response()->json([
                "message" => "No se encontro la categoria",
            ], 404);
        }

        if( $request['name'] )
        {
            $request['slug'] = $this->createSlug($request['name']);
        }

        $category->update( $request->all() );

        return response()->json([
            "message" => "La categoria fue actualizada",
            "category" => new CategoryResource($category),
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if( !$category )
        {
            return response()->json([
                "message" => "No se encontro la categoria",
            ], 404);
        }

        $category->delete();

        
        return response()->json([
            "message" => "La categoria fue eliminada",
            "category" => $category
        ], 200);
    }

    private function createSlug(string $text)
    {
        $text = strtolower($text);

        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        
        $text = trim($text, '-');
        
        $text = preg_replace('/-+/', '-', $text);
        
        return $text;
    
    }
}
