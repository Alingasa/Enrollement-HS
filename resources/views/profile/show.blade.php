<x-filament::page>
    <div style="display: flex; align-items: center; padding: 20px; border: 1px solid #e0e0e0; border-radius: 15px; background: linear-gradient(135deg, #fdfdfd, #f3f3f3); box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);">
        <div style="flex: 1; text-align: center;">
            <img src="{{ $record->profile_image ? url($record->profile_image) : url('default_images/me.jpg') }}" alt="Profile Image" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease-in-out;">
        </div>
        <div style="flex: 2; padding-left: 20px; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin: 0; font-size: 26px; color: #333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">{{ $record->first_name }} {{ $record->middle_name }}</h2>
            <p style="margin: 10px 0 5px 0; font-size: 18px; color: #777; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Age: {{ $record->age }}</p>
            <p style="margin: 5px 0; font-size: 18px; color: #777; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Gender: {{ $record->gender }}</p>
        </div>
    </div>
</x-filament::page>
