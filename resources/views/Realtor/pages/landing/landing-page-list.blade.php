@extends('realtor.realtor_master')
@section('title', 'Landing Page List')
@section('content')
<style>
        /* Table background and responsive font */
    .custom-table-container {
        border-radius: 10px;
        padding: 1.5rem;
    }
    .table thead th {
        background: #e5f5c7;
        color: #333;
        font-weight: 600;
    }
    .table td, .table th {
        vertical-align: middle;
    }
    .action-btns {
        display: flex;
        gap: 0.25rem;
        flex-wrap: wrap;
    }
    @media (max-width: 576px) {
        .table {
            font-size: 0.85rem;
        }
        .action-btns {
            flex-wrap: nowrap;
            gap: 0.15rem;
        }
    }
    .dataTables_paginate .paginate_button.current {
        background-color: #91d20a !important;
        color: #fff !important;
        border: 1px solid #91d20a !important;
    }
    .dataTables_paginate .paginate_button {
        background-color: #f6faeb !important;
        color: #333 !important;
        border-color: #f6faeb !important;
        border-radius: 20px !important;
        margin: 0 2px;
    }
    .dataTables_paginate .paginate_button:hover:not(.current) {
        background-color: #e5f5c7 !important;
        color: #333 !important;
    }
</style>
<div class="custom-table-container">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h5 class="fw-bold mb-2 mb-md-0">Landing Pages</h5>
        <div class="dropdown">
            <button class="btn text-white dropdown-toggle" type="button" id="createLinkDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #91d20a;">
                <i class="fas fa-plus-circle me-1"></i> Create Link
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="createLinkDropdown">
                <li><a class="dropdown-item" href="#">Property One</a></li>
                <li><a class="dropdown-item" href="#">Property Two</a></li>
                <li><a class="dropdown-item" href="#">Property Three</a></li>
            </ul>
        </div>
    </div>
   
    <table class="table table-striped table-bordered text-sm align-middle mb-0 w-100" id="myTable" style="border-color: #91d20a;">
        <thead>
            <tr>
                <th>Link</th>
                <th>Property</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-nowrap"> Link 1</a>
                        <button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 1" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </td>
                <td>Property One Landing Page</td>
                <td>
                    <div class="action-btns">
                        <button type="button" class="btn btn-warning btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to deactivate this link?');">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to delete this link?');">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a target="blank" href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>   
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-nowrap"> Link 2</a>
                        <button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 2" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </td>
                <td>Property two Landing Page</td>
                <td>
                    <div class="action-btns">
                        <button type="button" class="btn btn-warning btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to deactivate this link?');">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to delete this link?');">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a target="blank" href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="text-nowrap"> Link 3</a>
                        <button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 3" title="Copy to clipboard">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </td>
                <td>Property three Landing Page</td>
                <td>
                    <div class="action-btns">
                        <button type="button" class="btn btn-warning btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to deactivate this link?');">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to delete this link?');">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a target="blank" href="{{ route('realtor.landing-page') }}" class="btn btn-info btn-sm px-2 py-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
@push('scripts')

<a href="#" class="text-nowrap"> Link 3</a>
<button type="button" class="btn btn-sm copy-btn flex-shrink-0" data-clipboard-text="Link 3" title="Copy to clipboard">
    <i class="fas fa-copy"></i>
</button>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            language: {
                paginate: {
                    previous: 'Previous',
                    next: 'Next'
                }
            },
            drawCallback: function () {
                const paginate = $('.dataTables_paginate');
                paginate.addClass('mt-3 text-center');
                paginate.find('.paginate_button').addClass('btn btn-sm mx-1 rounded-pill');

                // Custom styles for pagination
                paginate.find('.paginate_button.previous, .paginate_button.next').css({
                    backgroundColor: '#f6faeb',
                    color: '#333',
                    borderColor: '#f6faeb'
                });

                paginate.find('.paginate_button.current').css({
                    backgroundColor: '#91d20a',
                    color: '#fff',
                    border: '1px solid #91d20a'
                });

                paginate.find('.paginate_button').hover(function () {
                    if (!$(this).hasClass('current')) {
                        $(this).css({ backgroundColor: '#e5f5c7', color: '#333' });
                    }
                }, function () {
                    if (!$(this).hasClass('current')) {
                        $(this).css({ backgroundColor: '', color: '' });
                    }
                });

                $('.dataTables_info').addClass('text-muted mt-2');
            }
        });

        // Use event delegation for copy buttons since DataTables can redraw the table
        // $('#myTable').on('click', '.copy-btn', function() {
        //     console.log('Copy button clicked'); // Debugging line
        //     const button = this;
        //     const textToCopy = button.getAttribute('data-clipboard-text');

        //     navigator.clipboard.writeText(textToCopy).then(() => {
        //         const originalContent = button.innerHTML;
        //         button.innerHTML = '<i class="fas fa-check"></i> Copied!';
        //         button.disabled = true;

        //         setTimeout(() => {
        //             button.innerHTML = '<i class="fas fa-copy"></i>';
        //             button.disabled = false;
        //         }, 1500);
        //     }).catch(err => { // Corrected the catch statement
        //         console.error('Failed to copy text: ', err);
        //         alert('Failed to copy link.');
        //     });
        // });

        const copyButtons = document.querySelectorAll('.copy-btn');

        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('Copy button clicked'); // Debugging line
            //     const textToCopy = this.getAttribute('data-clipboard-text');
            //     navigator.clipboard.writeText(textToCopy).then(() => {
            //         const originalContent = this.innerHTML;
            //         this.innerHTML = '<i class="fas fa-check"></i> Copied!';
            //         this.disabled = true;

            //         setTimeout(() => {
            //             this.innerHTML = originalContent;
            //             this.disabled = false;
            //         }, 1500);
            //     }).catch(err => {
            //         console.error('Failed to copy text: ', err);
            //         alert('Failed to copy link.');
            //     });
            // });
        });

    });
</script>
@endpush