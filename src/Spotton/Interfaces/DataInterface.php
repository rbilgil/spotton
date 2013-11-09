<?php

namespace Spotton;

interface DataInterface
{
	public function new($text, Location $location);
	public function delete($id);
	public function upVote($id);
	public function get($id);
	public function getAll($id);
}