<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Environment;
use App\Models\Option;
use App\Models\Member;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ProjectSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();
        $environments = Environment::all();
        $members = Member::all();
        $options = Option::all();

        // 環境の検索条件
        if ($request->filled('environment')) {
            $query->where('environment_id', $request->input('environment'));
        }

        // 営業メンバーの検索条件
        if ($request->filled('member')) {
            $query->where('member_id', $request->input('member'));
        }

        // 契約期間
        if ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->input('start_date'));
            $query->where('start_date', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->input('end_date'));
            $query->where('end_date', '<=', $endDate);
        }

        // オプション
        if ($request->filled('options_id')) {
            $optionsId = $request->input('options_id');
            $query->whereHas('options', function ($q) use ($optionsId) {
                $q->whereIn('options.id', $optionsId);
            });
            // 選択されたオプションをセッションに保存
            session()->put('selected_options', $optionsId);
        } else {
            // オプションが指定されていない場合はセッションをクリア
            session()->forget('selected_options');
        }


        // フリーワード検索
        if ($request->filled('free_search')) {
            $searchTerm = $request->input('free_search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('project_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('contact_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('contact_email', 'like', '%' . $searchTerm . '%');
        });
    }

    $projects = $query->latest('updated_at')->paginate(10);

    return view('admin.index', ['projects' => $projects, 'environments' => $environments, 'members' => $members, 'options' => $options]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
