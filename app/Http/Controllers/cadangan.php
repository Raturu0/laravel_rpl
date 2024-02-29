<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', [
            'events' => $events,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Event = Event::find($id);
        $Event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully');
    }
    // routes functions
    /**
     * Show the form for creating a new Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with('comments')->find($id);
        return view('events.show', compact('event'));
    }
    /**
     * Show the form for editing the specified Event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', compact('event'));
    }

    public function destroyComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('events.index')->with('error', 'Komentar tidak ditemukan.');
        }

        $comment->delete();

        return redirect()->route('events.index')->with('success', 'Komentar berhasil dihapus.');
    }

    // public function createCommentForm($event)
    // {
    //     $event = Event::find($event);
    //     return view('events.createComment', compact('event'));
    // }

    public function createComment($eventId)
    {
        // Logika untuk menangani pembuatan komentar
        // Pastikan data yang diperlukan disimpan ke dalam database

        // return redirect()->route('events.show', ['Event' => $event])->with('success', 'Comment created successfully.');
        $event = Event::find($eventId);
        return view('events.createComment', [
            'event' => $event,
        ]);
    }

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

    public function storeComment(Request $request, $eventId)
    {

        // \Log::info($request->all());
        // \Log::info($eventId);

        Comment::create($request->all());
        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

}
