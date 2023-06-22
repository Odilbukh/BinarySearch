<?php

class BinarySearchTree
{
    private $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function insert($data)
    {
        $node = new Node($data);
        if ($this->root === null) {
            $this->root = $node;
        } else {
            $this->insertNode($this->root, $node);
        }
    }

    private function insertNode(&$node, &$newNode)
    {
        if ($newNode->data < $node->data) {
            if ($node->left === null) {
                $node->left = $newNode;
            } else {
                $this->insertNode($node->left, $newNode);
            }
        } else if ($newNode->data > $node->data) {
            if ($node->right === null) {
                $node->right = $newNode;
            } else {
                $this->insertNode($node->right, $newNode);
            }
        }
    }

    public function search($data)
    {
        return $this->searchNode($this->root, $data);
    }

    private function searchNode($node, $data)
    {
        if ($node === null || $node->data === null) {
            return null;
        }

        if ($data === $node->data) {
            return $node->data;
        }

        if ($data < $node->data) {
            return $this->searchNode($node->left, $data);
        } else {
            return $this->searchNode($node->right, $data);
        }
    }
}