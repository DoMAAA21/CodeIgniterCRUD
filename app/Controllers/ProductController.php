<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        echo view('layouts/header');
        echo view('products/index');
    }

    public function fetchAll()
    {
        $Product = new Product();
        $data = $Product->findAll();
        return $this->response->setJSON($data);
    }

    public function create()
    {

        $uploadDirectory = 'uploads';

        $uploadedFile = $this->request->getFile('upload');

        if ($uploadedFile->isValid()) {

            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move($uploadDirectory, $newName);

            $Product = new Product();
            $data = [
                'name' => $this->request->getVar('name'),
                'desc' => $this->request->getVar('desc'),
                'costPrice' => $this->request->getVar('costPrice'),
                'sellPrice' => $this->request->getVar('sellPrice'),
                'image' => $newName,
            ];

            if ($Product->insert($data)) {
                $responseData = [
                    'message' => 'Product created successfully',
                    'data' => $data,
                ];

                return $this->response
                    ->setStatusCode(200)
                    ->setJSON($responseData);
            } else {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['error' => 'Product creation failed.']);
            }
        } else {
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'Product creation failed.']);
        }
    }

    public function show($id)
    {
        $Product = new Product();
        $productInfo = $Product->find($id);

        if ($productInfo) {
            return $this->response->setJSON($productInfo);
        } else {
            return $this->response->setJSON(['error' => 'Product not found'])->setStatusCode(404);
        }
    }

    public function delete($id)
    {
        $Product = new Product();

        $uploadDirectory = 'uploads';

        $prod = $Product->find($id);
        if (!empty($prod['image'])) {
            $oldAvatarPath = $uploadDirectory . '/' . $prod['image'];
            if (is_file($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }
        $Product->delete($id);
        return json_encode(['message' => 'Product deleted successfully']);
    }

    public function update($id)
    {
        $Product = new Product();

        if (!is_null($this->request->getFile('upload'))) {
            $uploadDirectory = 'uploads';
            $uploadedFile = $this->request->getFile('upload');

            $newName = $uploadedFile->getRandomName();
            $uploadedFile->move($uploadDirectory, $newName);

            if (!empty($prod['image'])) {
                $oldAvatarPath = $uploadDirectory . '/' . $prod['image'];
                if (is_file($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }
            
            $data = [
                'name' => $this->request->getVar('name'),
                'desc' => $this->request->getVar('desc'),
                'costPrice' => $this->request->getVar('costPrice'),
                'sellPrice' => $this->request->getVar('sellPrice'),
                'image' => $newName,
            ];
            $Product->update($id, $data);
            $responseData = [
                'message' => 'Product updated successfully',
                'data' => $data,
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON($responseData);
        } else {

            $data = [
                'name' => $this->request->getVar('name'),
                'desc' => $this->request->getVar('desc'),
                'costPrice' => $this->request->getVar('costPrice'),
                'sellPrice' => $this->request->getVar('sellPrice'),
            ];
            $Product->update($id, $data);
            $responseData = [
                'message' => 'Product updated successfully',
                'data' => $data,
            ];

            return $this->response
                ->setStatusCode(200)
                ->setJSON($responseData);
        }
    }
}
