<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Add proper authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array|max:10', // Made optional
            'images.*' => [
                'required_with:images', // Only required if images array is present
                'file',
                'image',
                'mimes:jpeg,jpg,png,gif,webp,bmp,tiff,svg',
                'max:10240', // 10MB max per file
                'dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000'
            ],
            'stock' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'tags' => 'nullable|string|max:500',
            'specifications' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'images.max' => 'You can upload maximum 10 images.',
            'images.*.required_with' => 'If uploading images, each file must be valid.',
            'images.*.image' => 'Each file must be a valid image.',
            'images.*.mimes' => 'Images must be in JPEG, PNG, GIF, WebP, BMP, TIFF, or SVG format.',
            'images.*.max' => 'Each image must be smaller than 10MB.',
            'images.*.dimensions' => 'Images must be at least 100x100 pixels and no larger than 5000x5000 pixels.',
            'name.required' => 'Product name is required.',
            'description.required' => 'Product description is required.',
            'description.min' => 'Description must be at least 10 characters long.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price cannot be negative.',
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'Selected category is invalid.',
            'stock.required' => 'Stock quantity is required.',
            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
