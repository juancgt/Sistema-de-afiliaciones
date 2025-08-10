<?php

namespace Dist\Http\Requests;

use Carbon\Carbon;
use Dist\Models\Test;
use Dist\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestRequest extends FormRequest
{

    public function authorize()
    {
        //return true;
        $test_id = $this->route('test_id');
        $current_test = Test::findOrFail($test_id);
        $current_user = Auth::user();
        $current_course = $current_test->course;
        if($current_course->users()->where('id', $current_user->id)->count()<=0){
            return false;
        }
        $test_start_time = new Carbon($current_test->start_at);
        $test_end_time = new Carbon($current_test->end_at);
        $current_time = Carbon::now();
        if($current_time->isAfter($test_start_time)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
