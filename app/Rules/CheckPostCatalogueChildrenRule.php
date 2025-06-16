<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\PostCatalogue;

class CheckPostCatalogueChildrenRule implements Rule
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Xác định xem quy tắc xác thực có thành công không.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Kiểm tra nếu danh mục có danh mục con
        return !PostCatalogue::isNodeCheck($this->id);
    }

    /**
     * Lấy thông báo lỗi xác thực.
     *
     * @return string
     */
    public function message()
    {
        return __('messages.cannot_delete_category');
    }
}
