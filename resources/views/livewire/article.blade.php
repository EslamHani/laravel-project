<div>
    <div class="form-group">
        <input type="text" wire:model="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title">
        @error('title')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <input type="text" name="author" wire:model="author" class="form-control @error('author') is-invalid @enderror" placeholder="Author">
        @error('author')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <textarea name="body" wire:model="body" class="form-control @error('body') is-invalid @enderror" placeholder="Body"></textarea>
        @error('body')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
</div>
