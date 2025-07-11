<?php

use Livewire\WithFileUploads;
use App\Models\Tenant;
use App\Models\Domain;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

new class extends \Livewire\Volt\Component {
    use WithFileUploads;

    public string $name = '';
    public string $subdomain = '';
    public string $full_domain = '';
    public string $domain_type = 'subdomain';
    public ?UploadedFile $logo = null;
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $city = '';
    public string $state = '';
    public string $zip = '';
    public string $country = '';
    public string $theme = 'classic';
    public string $primary_color = '#ff5733';
    public Collection $tenants;
    public string $viewMode = 'card';

    public function mount(): void
    {
        $this->loadTenants();
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'domain_type' => 'required|in:subdomain,full',
            'subdomain' => [
                'required_if:domain_type,subdomain',
                'alpha_dash',
                function ($attribute, $value, $fail) {
                    if ($this->domain_type === 'subdomain') {
                        $full_domain = $value . '.' . config('app.domain');
                        if (Domain::where('domain', $full_domain)->exists()) {
                            $fail('The subdomain has already been taken.');
                        }
                    }
                },
            ],
            'full_domain' => [
                'required_if:domain_type,full',
                'string',
                'regex:/^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}$/',
                function ($attribute, $value, $fail) {
                    if ($this->domain_type === 'full') {
                        if (Domain::where('domain', $value)->exists()) {
                            $fail('The domain has already been taken.');
                        }
                    }
                },
            ],
            'logo' => 'nullable|image|max:1024',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'theme' => 'required|string|max:255',
            'primary_color' => 'required|string|max:7',
        ];
    }

    public function loadTenants(): void
    {
        $this->tenants = Tenant::with('domains')->get();
    }

    public function toggleView(): void
    {
        $this->viewMode = $this->viewMode === 'card' ? 'list' : 'card';
    }

    public function store(): void
    {
        dd('Store method reached');
        $validated = $this->validate();

        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
        }

        $tenant = Tenant::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zip'],
            'country' => $validated['country'],
            'theme' => $validated['theme'],
            'primary_color' => $validated['primary_color'],
            'logo_path' => $logoPath,
        ]);

        $full_domain = $this->domain_type === 'subdomain' ? $this->subdomain . '.' . config('app.domain') : $this->full_domain;
        $tenant->domains()->create(['domain' => $full_domain]);

        $this->loadTenants();
        dd('Resetting fields');
    }
};
?>

<div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Tenant Management</h1>

    @if (session('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-md shadow-sm" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <!-- Create Tenant Form -->
    <div class="bg-white shadow-xl rounded-lg p-6 md:p-8 mb-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 border-b pb-4">Create New Tenant</h2>
        <form wire:submit.prevent="store" class="space-y-8">
            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tenant Name</label>
                        <x-text-input id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="name" placeholder="e.g., Acme Corporation" />
                        @error('name')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="domain_type" class="block text-sm font-medium text-gray-700 mb-1">Domain
                            Type</label>
                        <select id="domain_type" wire:model.live="domain_type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                            <option value="subdomain">Subdomain</option>
                            <option value="full">Full Domain</option>
                        </select>
                        @error('domain_type')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($domain_type === 'subdomain')
                        <div>
                            <label for="subdomain"
                                class="block text-sm font-medium text-gray-700 mb-1">Subdomain</label>
                            <div class="flex rounded-md shadow-sm">
                                <x-text-input id="subdomain"
                                    class="mt-1 flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                                    type="text" wire:model.live="subdomain" placeholder="e.g., acme" />
                                <span
                                    class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                    .{{ config('app.domain') ?? 'central.test' }}
                                </span>
                            </div>
                            @error('subdomain')
                                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div>
                            <label for="full_domain" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Domain</label>
                            <x-text-input id="full_domain"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                                type="text" wire:model.live="full_domain" placeholder="e.g., customdomain.com" />
                            @error('full_domain')
                                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!-- Logo Upload with Drop Area -->
                    <div>
                        <label for="logo-input" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                        <div x-data="{
                            file: null,
                            highlight: false,
                            handleDrop(e) {
                                this.file = e.dataTransfer.files[0];
                                this.$refs.fileInput.files = e.dataTransfer.files;
                                this.highlight = false;
                            },
                            handleFileSelect() { this.file = this.$refs.fileInput.files[0]; }
                        }"
                            class="border-2 border-dashed border-gray-300 p-6 text-center cursor-pointer hover:border-indigo-500 transition duration-150 ease-in-out"
                            :class="{ 'bg-indigo-100 border-indigo-500': highlight }"
                            @dragover.prevent="highlight = true" @dragleave.prevent="highlight = false"
                            @drop.prevent="handleDrop" @click="$refs.fileInput.click()">
                            <p class="text-gray-500">Drag and drop your logo here or click to select</p>
                            <input type="file" wire:model="logo" x-ref="fileInput" id="logo-input" class="hidden"
                                accept="image/*" @change="handleFileSelect">
                            <template x-if="file">
                                <div class="mt-4">
                                    <img :src="URL.createObjectURL(file)" alt="Logo preview" class="max-h-32 mx-auto">
                                </div>
                            </template>
                        </div>
                        @error('logo')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Contact Information</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <x-text-input id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="email" wire:model.live="email" placeholder="e.g., contact@acme.com" />
                        @error('email')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <x-text-input id="phone"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="phone" placeholder="e.g., +1 123 456 7890" />
                        @error('phone')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Address Information</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <x-text-input id="address"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="address" placeholder="e.g., 123 Main St" />
                        @error('address')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <x-text-input id="city"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="city" />
                        @error('city')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                        <x-text-input id="state"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="state" />
                        @error('state')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">Zip Code</label>
                        <x-text-input id="zip"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="zip" />
                        @error('zip')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <x-text-input id="country"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"
                            type="text" wire:model.live="country" />
                        @error('country')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Appearance -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Appearance</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="theme" class="block text-sm font-medium text-gray-700 mb-1">Theme</label>
                        <select id="theme" wire:model.live="theme"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                            <option value="classic">Classic</option>
                            <option value="dark">Dark</option>
                            <option value="modern">Modern</option>
                        </select>
                        @error('theme')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-1">Primary
                            Color</label>
                        <x-text-input id="primary_color"
                            class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-1"
                            type="color" wire:model.live="primary_color" />
                        @error('primary_color')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-6 flex justify-end">
                <x-primary-button type="submit">
                    Create Tenant
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Existing Tenants Section (Unchanged) -->
    <div class="bg-white shadow-xl rounded-lg p-6 md:p-8">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Existing Tenants</h2>
            <button wire:click="toggleView"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    @if ($viewMode === 'card')
                        <path fill-rule="evenodd"
                            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    @else
                        <path
                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM13 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
                    @endif
                </svg>
                Switch to {{ $viewMode === 'card' ? 'List View' : 'Card View' }}
            </button>
        </div>

        @if ($tenants->isEmpty())
            <p class="text-gray-600 text-center py-10">No tenants created yet.</p>
        @else
            @if ($viewMode === 'card')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tenants as $tenant)
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-200">
                            @if ($tenant->logo_path)
                                <img src="{{ Storage::url($tenant->logo_path) }}" alt="{{ $tenant->name }} Logo"
                                    class="h-16 w-auto mx-auto mb-4">
                            @endif
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $tenant->name }}</h3>
                            @foreach ($tenant->domains as $domain)
                                <p class="text-gray-700"><a href="http://{{ $domain->domain }}" target="_blank"
                                        class="text-indigo-600 hover:underline">{{ $domain->domain }}</a></p>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Domain</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $tenant->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @foreach ($tenant->domains as $domain)
                                            <a href="http://{{ $domain->domain }}" target="_blank"
                                                class="text-indigo-600 hover:underline block">{{ $domain->domain }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
</div>
