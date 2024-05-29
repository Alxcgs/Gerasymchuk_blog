<?php

namespace App\Http\Controllers\Blog\Admin;

//use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends BaseController{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(__METHOD__);
        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd(__METHOD__);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //dd(__METHOD__);
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd(__METHOD__);
        $item = BlogCategory::find($id);
        if (empty($item)) { //якщо ід не знайдено
            return back() //redirect back
                ->withErrors(['msg' => "Запис id=[{$id}] не знайдено"]) //видати помилку
                ->withInput(); //повернути дані
        }

        $data = $request->all(); //отримаємо масив даних, які надійшли з форми
        if (empty($data['slug'])) { //якщо псевдонім порожній
            $data['slug'] = Str::slug($data['title']); //генеруємо псевдонім
        }

        $result = $item->update($data);  //оновлюємо дані об'єкта і зберігаємо в БД

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успішно збережено']);
        } else {
            return back()
                ->with(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd(__METHOD__);
    }
}
