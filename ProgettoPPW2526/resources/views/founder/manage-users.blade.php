<manage-users.blade.php>

    <div class="p-6">
        <h1 class="text-xl font-bold_mb-4">
            Gestione dei ruoli utenti
        </h1>
        <form method="POST"action="{{route('founder.manage.users.updateAll')}}">
            @csrf
            @method('PATCH')
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ruolo</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                    <td>
                        <select name="roles[{{$user->id}}]">
                            @foreach (['founder','admin','moderator','editor','user'] as $role)
                                    <option value="{{$role}}" @selected($user->role===$role)>{{$role}}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </table>
        <button type="submit">Salva</button>
        </form>
    </div>
</manage-users.blade.php>
