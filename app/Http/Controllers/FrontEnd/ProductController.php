<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Business\Cart;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Http\Services\Review\ReviewService;

class ProductController extends Controller
{
    protected $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }
    public function index(MenuService $menuService, ProductService $productService, Request $request)
    {
        $menus = $menuService->getParent();
        $menuId = $request->query('menu_id');

        if ($menuId) {
            // Lấy tất cả menu con nếu menuId là danh mục cha
            $childMenuIds = $menuService->getChildMenuIds($menuId);
            $childMenuIds[] = $menuId; // Bao gồm cả menu cha
            $products = $productService->getByMenus($childMenuIds);
        } else {
            $products = $productService->getAll();
        }
        return view('frontend.product.product', [
            'title' => 'Sản phẩm',
            'menus' => $menus,
            'products' => $products
        ]);
    }

    public function detail(MenuService $menuService, int $productID)
    {

        $menus = $menuService->getParent();
        $sizes = Size::all();
        $product = resolve(ProductService::class)->show($productID, ["menu"]);
        $product->loadCount("reviews");
        
        $product->load(["sizes", "reviews"]);
        // Lấy danh mục con của sản phẩm
        $category = Menu::find($product->menu_id);

        // Kiểm tra danh mục cha của nó
        $parentCategory = $category ? Menu::find($category->parent_id) : null;

        // Kiểm tra danh mục cha cấp cao nhất
        $rootCategory = $parentCategory ? Menu::find($parentCategory->parent_id) : null;
        return view('frontend.product.productDetail', [
            "id" => $productID,
            'title' => 'Chi tiết sản phẩm',
            'menus' => $menus,
            "category" => $category,
            "parentCategory" => $parentCategory,
            "rootCategory" => $rootCategory,
            "sizes" => $sizes,
            "product" => $product,
            "availableSizes" => $product->sizes->pluck("id")->toArray(),
            "reviewCount" => (int) $product->reviews_count
        ]);
    }

    public function showDetailInPopup(int $productID)
    {
        $sizes = Size::all();
        $product = resolve(ProductService::class)->show($productID, ["menu"]);
        $product->load("sizes");
        return response()->json([
            "id" => $productID,
            "content" => view("frontend.product.includes.product_in_popup", [
                "sizes" => $sizes,
                "product" => $product,
                "availableSizes" => $product->sizes->pluck("id")->toArray()
            ])->render()
        ]);
    }
}
