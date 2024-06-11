<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;

class CleanUpOldAttendances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:attendances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Fetch all attendance entries sorted by creation date descending
        $attendances = Attendance::orderBy('created_at', 'desc')->get();

        // Keep the latest 50 entries
        $attendancesToKeep = $attendances->take(80000);
        $attendancesToDelete = $attendances->splice(80000);

        foreach ($attendancesToDelete as $attendance) {
            // skip if @attendance photo is null
            if ($attendance->photo === null) {
                continue;
            }

            // Delete the photo from storage
            if (Storage::exists($attendance->photo)) {
                Storage::delete($attendance->photo);
            }

            // Delete the attendance record from the database
            $attendance->delete();
        }

        $this->info('Old attendance photos and data cleaned up successfully.');
        return 0;
    }
}
