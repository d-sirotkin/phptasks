<?php

// app/Models/Comment.php
public function post()
{
    return $this->belongsTo(Post::class);
}