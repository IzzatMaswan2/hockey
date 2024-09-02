<!-- resources/views/matches/index.blade.php -->
<h1>Matches</h1>
<a href="{{ route('matches.create') }}">Create New Match</a>
<ul>
@foreach($matches as $match)
    <tr>
        <td>{{ $match->team_a }} vs {{ $match->team_b }}</td>
        <td>{{ $match->start_time }}</td>
        <td>{{ $match->status }}</td>
        <td>
            <a href="{{ route('matches.edit', $match->id) }}" class="btn btn-sm btn-update">Update</a>
            <form action="{{ route('matches.destroy', $match->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

</ul>
