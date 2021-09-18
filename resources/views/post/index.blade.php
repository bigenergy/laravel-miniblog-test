<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список моих постов') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-grid gap-2">
                        <a href="{{ route('posts.create') }}" class="btn btn-success">Создать пост</a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Модификатор</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>
                                    @if ($post->private)
                                        Приватный пост
                                    @else
                                        Публичный пост
                                    @endif
                                </td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    {{ Form::open([
                                                      'method' => 'DELETE',
                                                      'route' => ['posts.destroy', $post->id],
                                                 ]) }}
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Редактировать</a>

                                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>

                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <h3 class="mt-4">У вас еще нет постов</h3>
                                    <br>
                                    <a href="{{ route('posts.create') }}" class="btn btn-success">Создать свой первый пост</a>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
