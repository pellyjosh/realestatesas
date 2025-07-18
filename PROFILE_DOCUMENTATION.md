# Realtor Profile Functionality

## Overview

This implementation provides a comprehensive profile management system for realtors in the tenant-based real estate application. The profile allows realtors to view and edit their personal information, change passwords, and manage their account settings.

## Features

### ✅ Profile Viewing & Editing

-   **View Mode**: Display all profile information in a clean, organized layout
-   **Edit Mode**: Toggle to edit mode with inline form fields
-   **Profile Image**: Upload and change profile pictures with real-time preview
-   **Form Validation**: Client and server-side validation for all fields

### ✅ Personal Information Management

-   Basic information (name, email, phone)
-   Personal details (gender, date of birth, marital status)
-   Professional information (occupation, nationality)
-   Location details (state of origin, LGA, hometown)
-   Contact information (residential address)

### ✅ Security Features

-   **Password Change**: Secure password update with current password verification
-   **Account Deletion**: Option to delete account (with confirmation)
-   **Session Management**: Proper authentication handling

### ✅ User Experience

-   **AlpineJS Integration**: Reactive frontend without page reloads
-   **Loading States**: Visual feedback during operations
-   **Error Handling**: Comprehensive error messaging
-   **Success Notifications**: Toast notifications for successful operations
-   **Responsive Design**: Works on all device sizes

## Technical Implementation

### Backend (Laravel)

#### Controller: `App\Http\Controllers\Tenant\Realtor\ProfileController`

-   **`show()`**: Display the profile page
-   **`profileData()`**: API endpoint for profile data
-   **`update()`**: Update profile information
-   **`updatePassword()`**: Change password
-   **`destroy()`**: Delete account

#### Routes: `routes/tenant.php`

```php
Route::controller(RealtorProfileController::class)->group(function () {
    Route::get('/profile', 'show')->name('tenant.realtor.profile');
    Route::get('/profile/data', 'profileData')->name('tenant.realtor.profile.data');
    Route::patch('/profile', 'update')->name('tenant.realtor.profile.update');
    Route::patch('/profile/password', 'updatePassword')->name('tenant.realtor.profile.password');
    Route::delete('/profile', 'destroy')->name('tenant.realtor.profile.destroy');
});
```

#### Model: `App\Models\Tenant\TenantUser`

The profile uses the existing TenantUser model with fields:

-   Personal: name, email, phone, image_url
-   Details: gender, date_of_birth, marital_status, occupation
-   Location: nationality, state_of_origin, lga, hometown, residential_address
-   System: referral_code, created_at, updated_at

### Frontend (AlpineJS + Blade)

#### Key Alpine.js Data Properties

```javascript
{
    loading: false,              // Loading state
    editMode: false,             // Toggle edit/view mode
    showPasswordForm: false,     // Show password change form
    profileImage: '',            // Current profile image URL
    userData: {},                // User profile data
    originalData: {},            // Backup for cancel functionality
    passwordData: {},            // Password change form data
    selectedFile: null           // Selected image file
}
```

#### Key Methods

-   **`handleImageChange(event)`**: Handle profile image selection
-   **`saveProfile()`**: Save profile changes via AJAX
-   **`updatePassword()`**: Change password via AJAX
-   **`cancelEdit()`**: Cancel edit mode and restore original data
-   **`showNotification(message, type)`**: Show toast notifications

## File Structure

```
app/Http/Controllers/Tenant/Realtor/
└── ProfileController.php

app/Http/Requests/Tenant/
└── TenantProfileUpdateRequest.php

resources/views/themes/classic/realtor/pages/
└── profile.blade.php

public/themes/classic/realtor/assets/css/
└── profile.css

routes/
└── tenant.php (profile routes)
```

## Security Considerations

1. **Authentication**: All routes protected by `auth:tenant` middleware
2. **Authorization**: Only realtor user type can access
3. **Validation**: Comprehensive server-side validation
4. **File Upload**: Image validation and secure storage
5. **Password**: Hashed storage and current password verification
6. **CSRF**: Protected against CSRF attacks

## Usage Instructions

### For Realtors:

1. **Navigate** to the profile page via the main menu
2. **View** your current profile information
3. **Edit** by clicking the "Edit Profile" button
4. **Upload** a new profile image by clicking the camera icon
5. **Save** changes or cancel to revert
6. **Change Password** using the security section
7. **Update** any personal information as needed

### For Developers:

1. **Extend** validation rules in the controller or request class
2. **Add** new fields to the TenantUser model and migration
3. **Customize** the view layout in the Blade template
4. **Modify** Alpine.js behavior for additional features
5. **Style** with custom CSS in profile.css

## API Endpoints

-   `GET /realtor/profile` - Show profile page
-   `GET /realtor/profile/data` - Get profile data (JSON)
-   `PATCH /realtor/profile` - Update profile
-   `PATCH /realtor/profile/password` - Change password
-   `DELETE /realtor/profile` - Delete account

## Dependencies

-   **Laravel Framework**: Backend framework
-   **AlpineJS**: Frontend reactivity
-   **Bootstrap**: UI components and styling
-   **Font Awesome**: Icons
-   **Stancl/Tenancy**: Multi-tenant architecture

## Future Enhancements

1. **Profile Completion**: Progress indicator for profile completeness
2. **Social Media**: Integration with social media profiles
3. **Two-Factor Authentication**: Enhanced security
4. **Activity Log**: Track profile changes
5. **Export Data**: Download profile information
6. **Bulk Import**: Import profile data from CSV/Excel
7. **Profile Verification**: Email/phone verification badges
8. **Professional Credentials**: Add certifications and licenses

## Testing

The profile functionality should be tested for:

-   Form validation (client and server-side)
-   Image upload and storage
-   Password change security
-   Error handling
-   Responsive design
-   Cross-browser compatibility

## Support

For issues or questions regarding the profile functionality, refer to:

-   Laravel documentation for backend issues
-   AlpineJS documentation for frontend reactivity
-   Bootstrap documentation for styling issues
