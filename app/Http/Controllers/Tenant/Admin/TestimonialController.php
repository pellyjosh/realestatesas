<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    private function getSectionRow()
    {
        return DB::table('home_section')
            ->where('name', 'testimonials')
            ->first();
    }

    private function saveSectionRow($data, $limit = null)
    {
        $update = ['data' => json_encode($data)];
        if ($limit !== null) $update['limit'] = $limit;
        DB::table('home_section')
            ->where('name', 'testimonials')
            ->update($update);
    }

    public function index(Request $request)
    {
        $row = $this->getSectionRow();
        $data = $row ? json_decode($row->data, true) : [];
        $items = $data['items'] ?? [];
        $limit = $data['limit'] ?? 6;
        return response()->json(['items' => $items, 'limit' => $limit]);
    }

    public function store(Request $request)
    {
        $row = $this->getSectionRow();
        $data = $row ? json_decode($row->data, true) : ['items' => [], 'limit' => 6];
        $testimonial = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
        ]);
        $testimonial['id'] = uniqid('t_');
        // If a file was uploaded via multipart/form-data, prefer that
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials', 'public');
            $testimonial['image'] = Storage::url($path);
        } elseif (!empty($testimonial['image']) && str_starts_with($testimonial['image'], 'data:image')) {
            $testimonial['image'] = $this->saveBase64Image($testimonial['image']);
        }
        $data['items'][] = $testimonial;
        $this->saveSectionRow($data);
        return response()->json($testimonial, 201);
    }

    public function update(Request $request, $id)
    {
        $row = $this->getSectionRow();
        $data = $row ? json_decode($row->data, true) : ['items' => [], 'limit' => 6];
        $testimonial = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|string',
        ]);
        foreach ($data['items'] as &$item) {
            if ($item['id'] == $id) {
                foreach ($testimonial as $k => $v) {
                    if ($k === 'image') {
                        // prefer uploaded file if present
                        if ($request->hasFile('image')) {
                            $path = $request->file('image')->store('testimonials', 'public');
                            $v = Storage::url($path);
                        } elseif ($v && str_starts_with($v, 'data:image')) {
                            $v = $this->saveBase64Image($v);
                        }
                    }
                    $item[$k] = $v;
                }
            }
        }
        $this->saveSectionRow($data);
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $row = $this->getSectionRow();
        $data = $row ? json_decode($row->data, true) : ['items' => [], 'limit' => 6];
        $data['items'] = array_values(array_filter($data['items'], fn($item) => $item['id'] != $id));
        $this->saveSectionRow($data);
        return response()->json(['success' => true]);
    }

    public function setLimit(Request $request)
    {
        $row = $this->getSectionRow();
        $data = $row ? json_decode($row->data, true) : ['items' => [], 'limit' => 6];
        $limit = $request->validate(['limit' => 'required|integer|min:1|max:6'])['limit'];
        $data['limit'] = $limit;
        $this->saveSectionRow($data, $limit);
        return response()->json(['success' => true, 'limit' => $limit]);
    }

    private function saveBase64Image($base64)
    {
        $image = str_replace(' ', '+', $base64);
        $imageName = 'testimonials/' . uniqid() . '.png';
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
        Storage::disk('public')->put($imageName, $imageData);
        return Storage::url($imageName);
    }
}
