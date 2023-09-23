<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SellerRepository;

class SellerController extends Controller
{
    protected $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function index()
    {
        $sellers = $this->sellerRepository->all();

        return response()->json([
            "data" => $sellers
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->only(["name", "email"]);

        $seller = $this->sellerRepository->create($data);

        return response()->json([
            'data' => [
                'id' => $seller->id,
                'name' => $seller->name,
                'email' => $seller->email,
            ]
        ], 201);
    }
}
