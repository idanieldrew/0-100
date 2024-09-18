<?php

namespace App\Repositories;

abstract class BaseRepository
{
    public abstract function index();

    public abstract function store(array $data);

    public abstract function show($id);
}
