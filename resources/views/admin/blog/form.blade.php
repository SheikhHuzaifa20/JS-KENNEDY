<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text(
                    'name',
                    null,
                    'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('short_detail', 'Detail') !!}
                {!! Form::text(
                    'short_detail',
                    null,
                    'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('detail', 'Detail') !!}
                {!! Form::textarea(
                    'detail',
                    null,
                    'required' == 'required'
                        ? ['class' => 'form-control', 'id' => 'summary-ckeditor1', 'required' => 'required']
                        : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        {{-- <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('inner_detail', 'Inner Detail') !!}
                {!! Form::textarea(
                    'inner_detail',
                    null,
                    'required' == 'required'
                        ? ['class' => 'form-control', 'id' => 'summary-ckeditor2', 'required' => 'required']
                        : ['class' => 'form-control'],
                ) !!}
            </div>
        </div> --}}
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                <input class="form-control dropify" name="image" type="file" id="image"
                    {{ $blog->image != '' ? "data-default-file = /$blog->image" : '' }}
                    {{ $blog->image == '' ? 'required' : '' }} value="{{ $blog->image }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('event_datetime', 'Select Date & Time') !!}

                @php
                    $currentCanadianTime = now()->timezone('America/Toronto');
                    $formattedCanadianTime = $currentCanadianTime->format('Y-m-d\TH:i');
                    $displayTime = $currentCanadianTime->format('Y-m-d H:i');
                @endphp

                <input type="datetime-local" id="event_datetime" name="event_datetime" class="form-control"
                    placeholder="Current Time: {{ $displayTime }}" min="{{ $formattedCanadianTime }}"
                    value="{{ old('event_datetime', $formattedCanadianTime) }}" required>

                <small id="time_note" class="text-muted">
                    Current Time: {{ $displayTime }}
                </small>
            </div>
        </div>

    </div>
</div>

<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>


<script>
    function updateCanadianTime() {
        fetch("https://worldtimeapi.org/api/timezone/America/Toronto")
            .then(response => response.json())
            .then(data => {
                const date = new Date(data.datetime);
                const formatted = date.toISOString().slice(0, 16);
                const readable = formatted.replace("T", " ");

                const input = document.getElementById('event_datetime');
                const note = document.getElementById('time_note');

                // Update placeholder and min time
                input.placeholder = "Current Time: " + readable;
                input.min = formatted;
                note.textContent = "Current Time: " + readable;

                // If user’s current input < live time, auto-correct it
                if (!input.value || input.value < formatted) {
                    input.value = formatted;
                }
            })
            .catch(err => console.error("Time fetch error:", err));
    }

    // Initial run and update every 1 minute
    updateCanadianTime();
    setInterval(updateCanadianTime, 60000);
</script>
