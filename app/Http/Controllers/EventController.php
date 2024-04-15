<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private function validateEventData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required|string|max:1000',
            'category_id' => 'required|integer|exists:categories,id',
        ], [
            'name.required' => 'The name of the event is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'start_date.required' => 'You must specify a start date.',
            'start_date.date' => 'The start date must be a valid date.',
            'start_date.before' => 'The start date must be before the end date.',
            'end_date.required' => 'You must specify an end date.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after' => 'The end date must be after the start date.',
            'description.required' => 'Please provide a description for the event.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'category_id.required' => 'You must select a category for the event.',
            'category_id.integer' => 'The category ID must be an integer.',
            'category_id.exists' => 'The selected category does not exist.',
        ]);
        
    }

    public function deleteEvent(Event $event)
    {
        if (auth()->user()->id === $event->user_id) {
            $event->delete();
        }

        return redirect('/');
    }

    public function actuallyUpdateEvent(Event $event, Request $request)
    {
        if (auth()->user()->id !== $event->user_id) {
            return redirect('/');
        }

        $validatedData = $this->validateEventData($request);

        $event->update($validatedData);
        return redirect('/');
    }

    public function showEditScreen(Event $event)
    {
        if (auth()->user()->id !== $event->user_id) {
            return redirect('/');
        }

        return view('edit-event', ['event' => $event, 'categories' => Category::all()]);
    }

    public function showDetails(Event $event)
    {
        return view('event-details', ['event' => $event]);
    }

    public function createEvent(Request $request)
    {
        $validatedData = $this->validateEventData($request);

        $validatedData['user_id'] = auth()->id();

        Event::create($validatedData);

        return redirect('/');
    }

    public function seedData()
    {
        // Check if categories already exist
        // if (Category::count() > 0) {
        //     return redirect('/')->with('warning', 'Categories already exist. No need to seed.');
        // }

        // Seed categories
        $categories = [
            [
                'name' => 'Umiejętności kognitywne',
                'color_code' => '#336699',
            ],
            [
                'name' => 'Umiejętności programistyczne',
                'color_code' => '#993366',
            ],
            [
                'name' => 'Umiejętności językowe',
                'color_code' => '#669933',
            ],
            [
                'name' => 'Umiejętności artystyczne',
                'color_code' => '#993333',
            ],
            [
                'name' => 'Umiejętności sportowe',
                'color_code' => '#339933',
            ],
            [
                'name' => 'Umiejętności kulinarna',
                'color_code' => '#333399',
            ],
            [
                'name' => 'Umiejętności zarządzania czasem',
                'color_code' => '#993399',
            ],
        ];

        // Insert categories and retrieve their IDs
        $categoryIds = [];
        foreach ($categories as $category) {
            $categoryModel = Category::create($category);
            $categoryIds[] = $categoryModel->id;
        }

        // Check if events already exist
        if (Event::count() > 0) {
            return redirect('/')->with('warning', 'Events already exist. No need to seed.');
        }


        $events1 = [
            [
                'name' => 'Rozpoczęcie nauki czytania',
                'start_date' => '1995-01-04',
                'end_date' => '1996-01-04',
                'description' => 'Między 4 stycznia 1995 a 4 stycznia 1996 rozpocząłem naukę czytania, co stanowiło ważny krok w rozwijaniu moich umiejętności kognitywnych.',
                'user_id' => 1,
                'category_id' => $categoryIds[0], // Kategoria "Umiejętności kognitywne"
            ],
            [
                'name' => 'Pierwsze eksperymenty naukowe',
                'start_date' => '2003-01-04',
                'end_date' => '2004-01-04',
                'description' => 'Między 4 stycznia 2003 a 4 stycznia 2004 rozpocząłem pierwsze eksperymenty naukowe, co rozwijało moje umiejętności kognitywne i zainteresowanie nauką.',
                'user_id' => 1,
                'category_id' => $categoryIds[0], // Kategoria "Umiejętności kognitywne"
            ],
            [
                'name' => 'Pierwsze samodzielne rozwiązanie zadania matematycznego',
                'start_date' => '1998-01-04',
                'end_date' => '1999-01-04',
                'description' => 'Między 4 stycznia 1998 a 4 stycznia 1999 rozwiązałem moje pierwsze zadanie matematyczne samodzielnie, co świadczyło o rosnących umiejętnościach kognitywnych.',
                'user_id' => 1,
                'category_id' => $categoryIds[0], // Kategoria "Umiejętności kognitywne"
            ],
        ];
        $events2= [
            [
                'name' => 'Pierwszy program komputerowy',
                'start_date' => '2004-01-04',
                'end_date' => '2005-01-04',
                'description' => 'Między 4 stycznia 2004 a 4 stycznia 2005 napisałem swój pierwszy program komputerowy, co było początkiem mojej przygody z programowaniem.',
                'user_id' => 1,
                'category_id' => $categoryIds[1], // Kategoria "Umiejętności programistyczne"
            ],
            [
                'name' => 'Ukończenie kursu programowania',
                'start_date' => '2006-01-04',
                'end_date' => '2007-01-04',
                'description' => 'Między 4 stycznia 2006 a 4 stycznia 2007 ukończyłem kurs programowania, co pozwoliło mi zdobyć solidne podstawy w dziedzinie programistycznych umiejętności.',
                'user_id' => 1,
                'category_id' => $categoryIds[1], // Kategoria "Umiejętności programistyczne"
            ],
            [
                'name' => 'Pierwszy projekt programistyczny',
                'start_date' => '2008-01-04',
                'end_date' => '2009-01-04',
                'description' => 'Między 4 stycznia 2008 a 4 stycznia 2009 ukończyłem swój pierwszy projekt programistyczny, co stanowiło znaczący krok w rozwijaniu umiejętności programistycznych.',
                'user_id' => 1,
                'category_id' => $categoryIds[1], // Kategoria "Umiejętności programistyczne"
            ],
        ];
        $events3 = [
            [
                'name' => 'Pierwszy kurs języka obcego',
                'start_date' => '2005-01-04',
                'end_date' => '2006-01-04',
                'description' => 'Między 4 stycznia 2005 a 4 stycznia 2006 rozpocząłem swój pierwszy kurs języka obcego, co było początkiem mojej przygody z nauką nowych języków.',
                'user_id' => 1,
                'category_id' => $categoryIds[2], // Kategoria "Umiejętności językowe"
            ],
            [
                'name' => 'Przetłumaczenie pierwszej książki',
                'start_date' => '2010-01-04',
                'end_date' => '2011-01-04',
                'description' => 'Między 4 stycznia 2010 a 4 stycznia 2011 przetłumaczyłem swoją pierwszą książkę na inny język, co rozwijało moje umiejętności językowe.',
                'user_id' => 1,
                'category_id' => $categoryIds[2], // Kategoria "Umiejętności językowe"
            ],
            [
                'name' => 'Ukończenie kursu języka ojczystego',
                'start_date' => '2015-01-04',
                'end_date' => '2016-01-04',
                'description' => 'Między 4 stycznia 2015 a 4 stycznia 2016 ukończyłem kurs języka ojczystego, co umożliwiło mi pogłębianie umiejętności językowych w swoim języku rodzinnym.',
                'user_id' => 1,
                'category_id' => $categoryIds[2], // Kategoria "Umiejętności językowe"
            ],
        ];
        $events4 = [
            [
                'name' => 'Pierwszy kurs rysunku',
                'start_date' => '2003-01-04',
                'end_date' => '2004-01-04',
                'description' => 'Między 4 stycznia 2003 a 4 stycznia 2004 rozpocząłem swój pierwszy kurs rysunku, co było początkiem mojej przygody z sztuką plastyczną.',
                'user_id' => 1,
                'category_id' => $categoryIds[3], // Kategoria "Umiejętności artystyczne"
            ],
            [
                'name' => 'Pierwszy występ na scenie teatralnej',
                'start_date' => '2007-01-04',
                'end_date' => '2008-01-04',
                'description' => 'Między 4 stycznia 2007 a 4 stycznia 2008 wystąpiłem po raz pierwszy na scenie teatralnej, co rozwinęło moje umiejętności aktorskie i artystyczne.',
                'user_id' => 1,
                'category_id' => $categoryIds[3], // Kategoria "Umiejętności artystyczne"
            ],
            [
                'name' => 'Ukończenie kursu malowania olejnymi farbami',
                'start_date' => '2012-01-04',
                'end_date' => '2013-01-04',
                'description' => 'Między 4 stycznia 2012 a 4 stycznia 2013 ukończyłem kurs malowania olejnymi farbami, co poszerzyło moje umiejętności artystyczne i techniczne.',
                'user_id' => 1,
                'category_id' => $categoryIds[3], // Kategoria "Umiejętności artystyczne"
            ],
        ];
        $events5 = [
            [
                'name' => 'Pierwsze zawody sportowe',
                'start_date' => '1998-01-04',
                'end_date' => '1999-01-04',
                'description' => 'Między 4 stycznia 1998 a 4 stycznia 1999 wziąłem udział w swoich pierwszych zawodach sportowych, co było początkiem mojej przygody ze sportem.',
                'user_id' => 1,
                'category_id' => $categoryIds[4], // Kategoria "Umiejętności sportowe"
            ],
            [
                'name' => 'Ukończenie kursu pływania',
                'start_date' => '2005-01-04',
                'end_date' => '2006-01-04',
                'description' => 'Między 4 stycznia 2005 a 4 stycznia 2006 ukończyłem kurs pływania, co znacząco rozwijało moje umiejętności w tej dyscyplinie sportu.',
                'user_id' => 1,
                'category_id' => $categoryIds[4], // Kategoria "Umiejętności sportowe"
            ],
            [
                'name' => 'Pierwszy maraton biegowy',
                'start_date' => '2010-01-04',
                'end_date' => '2011-01-04',
                'description' => 'Między 4 stycznia 2010 a 4 stycznia 2011 ukończyłem swój pierwszy maraton biegowy, co było znaczącym osiągnięciem w rozwoju moich umiejętności sportowych.',
                'user_id' => 1,
                'category_id' => $categoryIds[4], // Kategoria "Umiejętności sportowe"
            ],
        ];
        $events6 = [
            [
                'name' => 'Pierwszy samodzielny posiłek',
                'start_date' => '2002-01-04',
                'end_date' => '2003-01-04',
                'description' => 'Między 4 stycznia 2002 a 4 stycznia 2003 przygotowałem swój pierwszy samodzielny posiłek, co stanowiło początek mojej przygody z kulinariami.',
                'user_id' => 1,
                'category_id' => $categoryIds[5], // Kategoria "Umiejętności kulinarna"
            ],
            [
                'name' => 'Ukończenie kursu gotowania',
                'start_date' => '2008-01-04',
                'end_date' => '2009-01-04',
                'description' => 'Między 4 stycznia 2008 a 4 stycznia 2009 ukończyłem kurs gotowania, co poszerzyło moje umiejętności kulinarnego gotowania i kreatywności w kuchni.',
                'user_id' => 1,
                'category_id' => $categoryIds[5], // Kategoria "Umiejętności kulinarna"
            ],
            [
                'name' => 'Pierwszy udany wielodaniowy obiad',
                'start_date' => '2013-01-04',
                'end_date' => '2014-01-04',
                'description' => 'Między 4 stycznia 2013 a 4 stycznia 2014 przygotowałem swój pierwszy udany wielodaniowy obiad, co było znaczącym osiągnięciem w rozwoju moich umiejętności kulinarnej.',
                'user_id' => 1,
                'category_id' => $categoryIds[5], // Kategoria "Umiejętności kulinarna"
            ],
        ];
        $events7 = [
            [
                'name' => 'Pierwszy plan dnia',
                'start_date' => '2005-01-04',
                'end_date' => '2006-01-04',
                'description' => 'Między 4 stycznia 2005 a 4 stycznia 2006 stworzyłem swój pierwszy plan dnia, co stanowiło początek mojej przygody z umiejętnością zarządzania czasem.',
                'user_id' => 1,
                'category_id' => $categoryIds[6], // Kategoria "Umiejętności zarządzania czasem"
            ],
            [
                'name' => 'Ukończenie kursu efektywnego zarządzania czasem',
                'start_date' => '2010-01-04',
                'end_date' => '2011-01-04',
                'description' => 'Między 4 stycznia 2010 a 4 stycznia 2011 ukończyłem kurs efektywnego zarządzania czasem, co pomogło mi w doskonaleniu tej umiejętności.',
                'user_id' => 1,
                'category_id' => $categoryIds[6], // Kategoria "Umiejętności zarządzania czasem"
            ],
            [
                'name' => 'Pierwszy projekt zakończony przed czasem',
                'start_date' => '2014-01-04',
                'end_date' => '2015-01-04',
                'description' => 'Między 4 stycznia 2014 a 4 stycznia 2015 zakończyłem swój pierwszy projekt przed terminem, co było znaczącym sukcesem w doskonaleniu umiejętności zarządzania czasem.',
                'user_id' => 1,
                'category_id' => $categoryIds[6], // Kategoria "Umiejętności zarządzania czasem"
            ],
        ];

        $events = array_merge($events1, $events2, $events3, $events4, $events5, $events6, $events7);

        // Insert events
        Event::insert($events);

        return redirect('/')->with('success', 'Data seeded successfully!');
    }
}
