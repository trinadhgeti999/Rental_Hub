@extends('layouts.app')

@section('content')
    <div class="room-form-wrapper">
        <div class="room-form-container">
            <h1 class="form-title">Add New Room</h1>

            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Room Name</label>
                    <input type="text" name="name" id="name" class="input-field" required>
                </div>

                <div class="form-group">
                    <label for="price_per_night">Price Per Night (₹)</label>
                    <input type="number" name="price_per_night" id="price_per_night" class="input-field" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="input-field textarea" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="text" name="image_url" id="image_url" class="input-field">
                </div>

                <div class="form-group">
                    <label for="owner_id">Select Owner</label>
                    <select name="owner_id" id="owner_id" class="input-field">
                        <option value="">Select Owner (Optional)</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ auth()->id() === $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    <small class="input-hint">Leave blank to assign the room to your account.</small>
                </div>

                <button type="submit" class="submit-btn">Add Room</button>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitButton.innerText = 'Submitting...';
        });
    });
</script>

@endsection
