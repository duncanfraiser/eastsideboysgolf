@extends('layouts.template')
@section('content')
<div class="flex-container">
    <div id="dayBox">
        <table id="dayTable">
            <tr>
                <th class="dayBoxHeader red-back" colspan="2">Joe's {{$archive->yr}} Overalls</th>
            </tr>
            <tr>
                <td class="blue-back" colspan="2">Score Stats</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Rounds Played</td>
                <td>{{$archive->overallRoundsPlayed()}}</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Average Scores</td>
                <td>{!!$archive->overallScore()!!}</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Putts Per Hole</td>
                <td>{!!$archive->overallPutts()!!}</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Birdies</td>
                <td>{!!$archive->overallBirdies()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Pars</td>
                <td>{!!$archive->overallPars()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Bogies</td>
                <td>{!!$archive->overallBogies()!!}%</td>
            </tr>
            <tr>
                <td class="green-back" colspan="2">Ball Position Stats</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Greens In Regulation</td>
                <td>{!!$archive->overallGIRs()!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Fairways Hit</td>
                <td>{!!$archive->overallFairways($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Left</td>
                <td>{!!$archive->overallFairwaysLeft($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Right</td>
                <td>{!!$archive->overallFairwaysRight($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Center</td>
                <td>{!!$archive->overallFairwaysCenter($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="gold-back" colspan="2">Hazard Stats</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Penalties</td>
                <td>{!!$archive->overallPenalty($archive->yr)!!}%</td>
            </tr>
            <tr>
                <td class="statsFirstCol">Sand Traps</td>
                <td>{!!$archive->overallSand($archive->yr)!!}%</td>
            </tr>
        </table>
  </div>

    @foreach ($scorecards as $key => $scorecard)
        <div id="dayBox">
            <table id="dayTable">
                <tr>
                    <th class="dayBoxHeader red-back" colspan="2">{!!$scorecard->name!!}</th>
                </tr>
                <tr>
                    <td class="blue-back" colspan="2">Score Stats</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Rounds Played</td>
                    <td>{!!$scorecard->rounds()->count()!!}</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Average Scores</td>
                    <td>{!!$scorecard->getAvgCourseScore($archive->yr)!!}</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Putts Per Hole</td>
                    <td>{!!$scorecard->getAvgCoursePutts($archive->yr)!!}</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Birdies</td>
                    <td>{!!$scorecard->getAvgCourseBirdies($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Pars</td>
                    <td>{!!$scorecard->getAvgCoursePars($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Bogies</td>
                    <td>{!!$scorecard->getAvgCourseBogies($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="green-back" colspan="2">Ball Position Stats</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Greens In Regulation</td>
                    <td>{!!$scorecard->getAvgCourseGIRs($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Fairways Hit</td>
                    <td>{!!$scorecard->getAvgCourseFairways($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Left</td>
                    <td>{!!$scorecard->getAvgCourseFairwaysLeft($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Right</td>
                    <td>{!!$scorecard->getAvgCourseFairwaysRight($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Center</td>
                    <td>{!!$scorecard->getAvgCourseFairwaysCenter($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="gold-back" colspan="2">Hazard Stats</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Penalties</td>
                    <td>{!!$scorecard->getAvgCoursePenalty($archive->yr)!!}%</td>
                </tr>
                <tr>
                    <td class="statsFirstCol">Sand Traps</td>
                    <td>{!!$scorecard->getAvgCourseSand($archive->yr)!!}%</td>
                </tr>
            </table>
        </div>
    @endforeach
</div>
@endsection
