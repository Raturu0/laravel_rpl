<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    // Menampilkan halaman utama
    public function index()
    {
        $events = Event::all();
        return view('events.index', [
            'events' => $events,
        ]);
    }

    // Menyimpan data baru event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        Event::create($request->all());
        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    // mengupdate data event
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $event = Event::find($id);
        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    // menghapus data event
    public function destroy($id)
    {
        $Event = Event::find($id);
        $Event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully');
    }

    // Menampilkan halaman untuk buat event
    public function create()
    {
        return view('events.create');
    }

    // Menampilkan comment pada suatu event
    public function show($id)
    {
        $event = Event::with('comments')->find($id);
        return view('events.show', compact('event'));
    }

    // Menampilkan halaman untuk mengedit event
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    // Menghapus comment
    public function destroyComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('events.index')->with('error', 'Komentar tidak ditemukan.');
        }

        $comment->delete();

        return redirect()->route('events.index')->with('success', 'Komentar berhasil dihapus.');
    }

    // Menampilkan halaman untuk membuat comment
    public function createComment($eventId)
    {
        $event = Event::find($eventId);
        return view('events.createComment', [
            'event' => $event,
        ]);
    }

    // Mengupdate comment
    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('events.index')->with('error', 'Komentar tidak ditemukan.');
        }

        // Periksa apakah komentar ditemukan sebelum memanggil metode update
        $comment->update($request->all());

        return redirect()->route('events.index')->with('success', 'Komentar berhasil diperbarui.');
    }

    // masuk ke halaman edit comment
    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);

        if (!$comment) {
            return redirect()->route('events.index')->with('error', 'Komentar tidak ditemukan.');
        }

        return view('events.editComment', compact('comment'));
    }

    // Menyimpan data comment
    public function storeComment(Request $request, $eventId)
    {

        Comment::create($request->all());
        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

}
