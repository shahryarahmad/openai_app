<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AIQuery;
use Illuminate\Support\Facades\Auth;
use OpenAI;

class AIController extends Controller
{
    public function index()
    {
        $queries = AIQuery::where('user_id', Auth::user()->id)->latest()->get();
        
        return view('dashboard', compact('queries'));
    }

    public function generateResponse(Request $request)
    {
        $request->validate(['prompt' => 'required|string']);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $request->gptOption,
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $request->prompt],
            ],
            'max_tokens' => 100,
        ]);
        
        // Fetch the assistant's response from the returned JSON
        $responseData = $response->json();
        
        // Extract the content from the assistant's message
        $assistantMessage = $responseData['choices'][0]['message']['content']  ?? 'Error generating response';
        
        // Optionally, return the assistant's message to the frontend
        // Save to database
        $query = AIQuery::create([
            'user_id' => Auth::user()->id,
            'prompt' => $request->prompt,
            'response' => $assistantMessage,
        ]);

        return redirect()->route('dashboard')->with('message', 'Response generated!');
    }
}
