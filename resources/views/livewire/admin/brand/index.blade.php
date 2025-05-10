<div>

@include('livewire.admin.brand.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Brand List</h4>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-small float-end">Add Brands</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stiped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)

                                                        <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->status == '1' ? 'hidden' : 'visible }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-success">Edit</a>
                                    <a href="" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4">No Brands Found </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>
    window.addEventListener('close-modal', event => {
        $('#addBrandModal').modal('hide');
    });
    </script>

@endpush
