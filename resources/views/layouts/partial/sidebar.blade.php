<div class="list-group category_item">
    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
    {{-- <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('category*') ? 'active' : '' }}">Category</a>
    <a href="{{ route('blog.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('blog*') ? 'active' : '' }}">Blog</a> --}}
    {{-- <a href="{{ route('author.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('author*') ? 'active' : '' }}">Author</a>
    <a href="{{ route('book.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('book*') ? 'active' : '' }}">Book</a>
    <a href="{{ route('member.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('member*') ? 'active' : '' }}">Member</a>
    <a href="{{ route('borrow.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('borrow*') ? 'active' : '' }}">Borrow Book</a>

    <a href="{{ route('allUser') }}" class="list-group-item list-group-item-action {{ Request::routeIs('allUser') ? 'active' : '' }}">User</a>
    <a href="{{ route('role.index') }}" class="list-group-item list-group-item-action {{ Request::routeIs('role*') ? 'active' : '' }}">Role</a> --}}

</div>
