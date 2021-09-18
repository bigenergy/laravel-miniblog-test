<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создать новый пост') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! Form::open([
                        'route' => 'posts.store',
                        'method' => 'post',
                    ]) !!}
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Заголовок поста</label>
                            {{ Form::text('title', null, ['class' => 'form-control', 'required']) }}
                            <div id="emailHelp" class="form-text">Придумайте что-нибудь уникальное, что зацепит читателей</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Содержание</label>
                            {{ Form::textarea('content', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="mb-3">
                            {{ Form::select('private', [1 => "Приватный пост", 0 => "Публичный пост"], null, ['placeholder' => 'Выберите модификатор доступа поста', 'class' => 'form-control', 'required']) }}
                        </div>
                        <button type="submit" class="btn btn-primary">Запостить</button>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
