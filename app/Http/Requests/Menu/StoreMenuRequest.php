<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có được phép gửi request này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Mặc định cho phép
    }

    /**
     * Xác định các luật kiểm tra dữ liệu cho request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'menu_catalogue_id' => 'required|integer|min:1',
            'menu.name' => 'required|array|min:1',         
            'menu.name.*' => 'required|string|max:255',   

            'menu.canonical' => 'required|array|min:1',    
            'menu.canonical.*' => 'required|string|max:255',

            'menu.order' => 'required|array|min:1',       
            'menu.order.*' => 'required|integer|min:0',  

            'menu.id' => 'sometimes|array',               
            'menu.id.*' => 'sometimes|integer|min:0', 
        ];
    }

    /**
     * Xác định các thông báo lỗi tuỳ chỉnh.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        $messages = __('validation_create.menu');
    
        return [
            'menu_catalogue_id.required' => $messages['menu_catalogue_id']['required'],
            'menu_catalogue_id.integer' => $messages['menu_catalogue_id']['integer'],
            'menu_catalogue_id.min' => $messages['menu_catalogue_id']['min'],
    
            'menu.name.required' => $messages['name']['required'],
            'menu.name.array' => $messages['name']['array'],
            'menu.name.min' => $messages['name']['min'],
            'menu.name.*.required' => $messages['name.*']['required'],
            'menu.name.*.string' => $messages['name.*']['string'],
            'menu.name.*.max' => $messages['name.*']['max'],
    
            'menu.canonical.required' => $messages['canonical']['required'],
            'menu.canonical.array' => $messages['canonical']['array'],
            'menu.canonical.min' => $messages['canonical']['min'],
            'menu.canonical.*.required' => $messages['canonical.*']['required'],
            'menu.canonical.*.string' => $messages['canonical.*']['string'],
            'menu.canonical.*.max' => $messages['canonical.*']['max'],
            'menu.canonical.*.unique' => $messages['canonical.*']['unique'],
    
            'menu.order.required' => $messages['order']['required'],
            'menu.order.array' => $messages['order']['array'],
            'menu.order.min' => $messages['order']['min'],
            'menu.order.*.required' => $messages['order.*']['required'],
            'menu.order.*.integer' => $messages['order.*']['integer'],
            'menu.order.*.min' => $messages['order.*']['min'],
    
            'menu.id.array' => $messages['id']['array'],
            'menu.id.*.integer' => $messages['id.*']['integer'],
            'menu.id.*.min' => $messages['id.*']['min'],
        ];
    }
    

    /**
     * Chuẩn bị dữ liệu trước khi kiểm tra hợp lệ.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $menuData = $this->input('menu', []);

        $maxItems = max(
            count($menuData['name'] ?? []),
            count($menuData['canonical'] ?? []),
            count($menuData['order'] ?? []),
            count($menuData['id'] ?? [])
        );

        $this->merge([
            'menu' => [
                'name' => array_pad($menuData['name'] ?? [], $maxItems, null),
                'canonical' => array_pad($menuData['canonical'] ?? [], $maxItems, null),
                'order' => array_pad($menuData['order'] ?? [], $maxItems, 0),
                'id' => array_pad($menuData['id'] ?? [], $maxItems, 0),
            ]
        ]);
    }
}
