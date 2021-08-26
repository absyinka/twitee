<?php

namespace App\Interfaces;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;

interface IPostInterface
{
    public function getAll();

    public function getById($id);

    public function create(StorePostRequest $request);

    public function delete(Request $request, $id);
}
