<?php

class Either {
    private $left;
    private $right;

    private function __construct($left, $right) {
        $this->left = $left;
        $this->right = $right;
    }

    public static function left($value) {
        return new self($value, null);
    }

    public static function right($value) {
        return new self(null, $value);
    }

    public function map(callable $fn) {
        if ($this->right !== null) {
            return self::right($fn($this->right));
        } else {
            return $this;
        }
    }

    public function flatMap(callable $fn) {
        if ($this->right !== null) {
            return $fn($this->right);
        } else {
            return $this;
        }
    }

    public function get() {
        if ($this->right !== null) {
            return $this->right;
        } else {
            throw new Exception("Either is in a left state.");
        }
    }

    public function getOrElse(callable $fn) {
        if ($this->right !== null) {
            return $this->right;
        } else {
            return $fn($this->left);
        }
    }

    public function isRight() {
        return $this->right !== null;
    }

    public function isLeft() {
        return $this->right === null;
    }
}