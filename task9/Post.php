<?php

// app/Models/Post.php
public function comments()
{
    return $this->hasMany(Comment::class);
}