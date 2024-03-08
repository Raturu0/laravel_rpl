<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{

    // Menampilkan halaman untuk buat event
    public function create()
    {
        return view('events.create');
    }

    // Menyimpan data baru event
    public function store(Request $request)
    {

        // berada di folder storage -> log -> untuk debugging
        Log::info($request->all());

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // $event = new Event();

        // Event::create($request->all());
        
        
        // ini bisa langsung all, detailnya kek gini
        Event::create([
            'title' => $request->title,
            'body' => $request->body,

        ]);
        return redirect()->route('events.index')
            ->with('successEvent', 'Sukses Buat Event Baru.');
    }

    // Menampilkan halaman utama
    public function index()
    {
        $events = Event::all();
        return view('events.index', [
            'events' => $events,
        ]);
    }

    // Menampilkan halaman untuk mengedit event
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
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
            ->with('successUpdateEvent', 'Sukses Update Event.');
    }

    // menghapus data event
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('failed', 'Event not found.');
        }

        // Hapus semua komentar terlebih dahulu
        $event->comments()->delete();

        // Setelah itu, baru hapus event
        $event->delete();

        return redirect()->route('events.index')->with('successDeleteEvent', 'Sukses Menghapus Event.');
    }

    // ----------------------------------------------
    // ---------COMMENT-----------------------------
    // ----------------------------------------------

    // Menampilkan halaman untuk membuat comment
    public function createComment($eventId)
    {
        $event = Event::find($eventId);
        return view('events.createComment', [
            'event' => $event,
        ]);
    }

    // Menyimpan data comment
    public function storeComment(Request $request, $eventId)
    {
        Comment::create($request->all());
        return redirect()->route('events.index')
            ->with('successComment', 'Comment created successfully.');
    }

    // Menampilkan comment pada suatu event
    public function show($id)
    {
        $event = Event::with('comments')->find($id);
        // melempar event yang kesimpan ke show.blade, dengan begitu di show bisa makai event untuk memanggil2
        return view('events.show', compact('event'));
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

    // Mengupdate comment
    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('events.index')
                ->with('error', 'Komentar tidak ditemukan.');
        }
        // Periksa apakah komentar ditemukan sebelum memanggil metode update
        $comment->update($request->all());
        return redirect()->route('events.index')->with('success', 'Komentar berhasil diperbarui.');
    }

    // Menghapus comment
    public function destroyComment($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->route('events.index')
                ->with('error', 'Komentar tidak ditemukan.');
        }
        $comment->delete();
        return redirect()->route('events.index')
            ->with('success', 'Komentar berhasil dihapus.');
    }

}