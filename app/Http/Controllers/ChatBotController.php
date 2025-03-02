<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function chat(Request $request)
    {
        $userInput = $request->input('message');

        // Retrieve previous chat history from session
        $chatHistory = session()->get('chat_history', []);

        // Append user input to chat history
        $chatHistory[] = ["role" => "user", "text" => $userInput];

        // Define the knowledge base (removing 'system' role)
        $knowledgebase = "Knowledge Base: This is who I am, I am Joshua Salceda a Magna Cum Laude graduate of Information Technology from Cavite State University - Bacoor Campus, I graudated last September 19, 2025. I was born on March 23, 2000. I have been recognized as a top IT student, a consistent Dean’s Lister, and has received multiple awards, including Best Research Presenter and Best Research Proposal during my university’s research colloquium.

                        I specializes in full-stack web development, particularly in Laravel, Django, ASP.NET Core and React.js(with Vite)/Next.js and Spring Boot (only for simple API). I have hands-on experience with database management using Oracle and MySQL, PostgreSQL as well as frontend technologies like React.js, HTML5, CSS3, Bootstrap, Tailwind CSS, axios, vite, JQuery and HTMX. My technical expertise extends to RESTful API development, version control with Git, and cloud deployment.

                        During my on-the-job training at Philippine Health Insurance Corporation Central Office, I played a key role in developing a Benefit Package Management System (a protoype), handling both frontend and backend development. I have also led capstone projects, including a Web-Based Management Information System for Mambog Elementary School and I developed a Funeral Management System for Torres Escaro Funeral Services (as a cpastone project, a commisioned one).

                        Aside from my technical skills, I have experience in customer service and teaching, conducting Sunday school lessons and training students in Microsoft Office applications. I am passionate about software development, eager to learn new technologies, and continuously improving my problem-solving skills by working on projects in Python, Java, and JavaScript frameworks.

                        With a strong academic background, proven leadership in research, and practical industry experience, I can say I am highly capable of contributing to any team as a software developer, application developer, or full-stack engineer. I am open to new opportunities and challenges that will allow me to grow as a professional and make a positive impact on society.

                        Hobbies: I love to read books, I love to walk, I play guitar a little bit and I play drums at church. I am a Christian.

                        Girlfriend: I have one and I love her so much she is Jennefer Morabor, She;s Beuatiful with a very sift heart.

                        Mother: My mother Is Victoria Salceda.

                        You can contact me Through my email: joshuasalceda0021@gmail.com.

                        Work: I currently work as a Software Developer at CosmoTech Phillipines, and I am currently on training about Software Development Life Cycle (SDLC).

                        You will be responding to the incoming question, don't give anything about me yet if no direct questions about me is asked but offer to be asked about me, asnwer as if you ar me, like you are joshua salceda, respond as casual, answer if need, if ever the question is not about whatever in the knowledge base, simply responed 'I'am sorry, I don't have an answer right now.' don't mention the phrase 'knowledge base' provided to you, if the question is about me and answerable through the knowledge base, please don't answer plainly,
                        make it casual but professional, again don't give information unless asked and don't send greetins if you already sent one, if you are ask with 'who' questions, only asnwer if it is about me or my girlfriend or mother as provided in the knowledgebase, also, stop re introducing yourself once you did already unless spicifically asked. Now, respond to the incoming question strictly based on the knowledge base nothing else:";

        // Construct conversation (removing 'system' role)
        $conversation = array_merge([["role" => "user", "text" => $knowledgebase]], $chatHistory);

        try {
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=AIzaSyCGBj3R-CP6PXdeZEP1r117SVO8DgqP6QA", [
                'contents' => array_map(fn($msg) => ['role' => $msg['role'], 'parts' => [['text' => $msg['text']]]], $conversation)
            ]);

            // Log the raw response for debugging
            Log::info('Gemini API Response:', ['response' => $response->body()]);

            if ($response->successful()) {
                $responseData = $response->json();

                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    $botMessage = $responseData['candidates'][0]['content']['parts'][0]['text'];
                } else {
                    $botMessage = "I'm sorry, I don't have an answer right now.";
                }

                // Append AI response to chat history
                $chatHistory[] = ["role" => "model", "text" => $botMessage];

                // Store updated history in session
                session()->put('chat_history', $chatHistory);

                return response()->json(["message" => $botMessage]);
            } else {
                Log::error('Gemini API Error', ['response' => $response->body()]);
                return response()->json(['error' => 'Failed to generate a response'], 500);
            }
        } catch (\Exception $e) {
            Log::error('API Request Failed', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

}
