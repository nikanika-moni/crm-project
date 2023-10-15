<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Environment;
use App\Models\Option;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $projects = Project::latest('updated_at')->paginate(5);
        $environments = Environment::all();
        $members = Member::all();
        $options = Option::all();
        return view('admin.index', ['projects' => $projects, 'environments' => $environments, 'members' => $members, 'options' => $options]);
    }


    public function create()
    {
        $environments = Environment::all();
        $members = Member::all();
        $options = Option::all();

        return view('admin.create', compact('environments', 'members', 'options'));
    }


    public function store(ProjectRequest $request)
    {
        $project = new Project($request->validated());
        $project->save();

        if ($project['auto_renewal']) {
            $project['end_date'] = null;
        }

        $environment = Environment::find($request->input('environment_id'));
        $member = Member::find($request->input('member_id'));
        $options = $request->input('options_id', []);
        $selectedOptions = Option::whereIn('id', $options)->get();


        $project->environment()->associate($environment);
        $project->member()->associate($member);
        $project->options()->sync($selectedOptions);

        return redirect()->route('admin.index')->with('success', 'プロジェクトを入力しました');
    }

    public function edit(project $project)
    {
        $environments = Environment::all();
        $members = Member::all();
        $options = Option::all();
        return view('admin.edit', ['project' => $project,
            'environments' => $environments,
            'members' => $members,
            'options' => $options,
        ]);
    }

        // 指定したIDのブログの更新処理
        public function update(ProjectRequest $request, $id)
        {
            $project = Project::findOrFail($id);
            $updateData = $request->validated();

            $project->environment()->associate($updateData['environment_id']);
            $project->member()->associate($updateData['member_id']);
            $project->options()->sync($updateData['options_id'] ?? []);
            Log::debug('オプションID: ' . json_encode($updateData['options_id']));
            $project->update($updateData);

            // return to_route('admin.index')->with('success', 'ブログを更新しました');
            return redirect()->route('admin.index')->with('success', 'ブログを更新しました');
        }



    public function show(Project $project)
    {
        $environments = Environment::all();
        $members = Member::all();
        $options = Option::all();
        return view('admin.detail', ['project' => $project,
        'environments' => $environments,
        'members' => $members,
        'options' => $options,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return to_route('admin.index')->with('success', 'ブログを削除しました');
    }
}
