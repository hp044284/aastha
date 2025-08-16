<?php
    use Carbon\Carbon;
    use App\Models\User;
    use App\Models\Setting;
    use App\Models\Product_Category;
    use App\Models\Service_Category;

    if (! function_exists('Get_User'))
    {
        function Get_User($id)
        {
            return User::where('id',$id)->first();
        }
    }

    if (! function_exists('Has_Permission'))
    {
        function Has_Permission($permission, $permission_type)
        {
            if (Auth::check())
            {
                return Auth::user()->HasPermission($permission, $permission_type);
            }
        }
    }

    if (! function_exists('Get_Product_Categories'))
    {
        function Get_Product_Categories()
        {
            return ProductCategory::where('Parent_Id',0)->where('Status',1)->get();
        }
    }

    if (! function_exists('Get_Service_Categories'))
    {
        function Get_Service_Categories()
        {
            return ServiceCategory::where('Parent_Id',0)->where('Status',1)->get();
        }
    }

    if (!function_exists('getDynamicImage'))
    {
        /**
         * Get the URL of an image or a default placeholder.
         *
         * @param string|null $fileName The name of the file.
         * @param string $directory The directory where the file is stored (relative to public).
         * @param string $defaultImage The default placeholder image.
         * @return string The URL of the image.
         */
        function getDynamicImage(?string $fileName, string $directory, string $defaultImage = 'logo.png'): string
        {
            // return $fileName;die;
            // Build the full path to the file
            $filePath = public_path("$directory/$fileName");
            // Check if the file exists
            if (!empty($fileName) && \File::exists($filePath))
            {
                return asset("$directory/$fileName");
            }
            // Return the default image URL if the file doesn't exist
            return asset("images/".$defaultImage);
        }
    }

    if (!function_exists('carbonFormatDate'))
    {
        /**
         * Format a date in a specified format.
         *
         * @param string|null $date The date to format (e.g., from the database).
         * @param string $format The desired date format (default: 'F j, Y').
         * @return string|null The formatted date or null if input is invalid.
         */
        function carbonFormatDate(?string $date, string $format = 'F j, Y'): ?string
        {
            $formatedDate = '';
            if (!empty($date))
            {
                try
                {
                    return $formatedDate = Carbon::parse($date)->format($format);
                }
                catch (Exception $e)
                {
                    // Log the error if necessary
                    return $formatedDate; // Return null for invalid dates
                }
            }
            return $formatedDate; // Return null if date is empty
        }
    }

    if (!function_exists('carbonFormatDateTime'))
    {
        /**
         * Format a date in a specified format.
         *
         * @param string|null $date The date to format (e.g., from the database).
         * @param string $format The desired date format (default: 'F j, Y g:i a').
         * @return string|null The formatted date or null if input is invalid.
         */
        function carbonFormatDateTime(?string $date, string $format = 'F j, Y g:i a'): ?string
        {
            $formattedDate = '';
            if (!empty($date))
            {
                try
                {
                    return $formattedDate = Carbon::parse($date)->format($format);
                }
                catch (Exception $e)
                {
                    // Log the error if necessary
                    return $formattedDate; // Return null for invalid dates
                }
            }
            return $formattedDate; // Return null if date is empty
        }
    }

    if (!function_exists('truncateText'))
    {
        /**
         * Truncate a string to a specified number of words.
         *
         * @param string|null $text The input text to truncate.
         * @param int $wordsLimit The maximum number of words to include.
         * @param string $end The string to append at the end (default: '...').
         * @return string The truncated text or an empty string if input is invalid.
         */
        function truncateText(?string $text, int $wordsLimit = 10, string $end = '...'): string
        {
            if (!empty($text))
            {
                return \Illuminate\Support\Str::words($text, $wordsLimit, $end);
            }

            return '';
        }
    }

    if (!function_exists('splitString'))
    {
        /**
         * Split a string into an array based on a specified delimiter.
         *
         * @param string|null $string The input string to split.
         * @param string $delimiter The delimiter to use for splitting (default: ',').
         * @return array The resulting array or an empty array if the input is null or empty.
         */
        function splitString(?string $string, string $delimiter = ','): array
        {
            if (!empty($string))
            {
                return explode($delimiter, $string);
            }
            return []; // Return an empty array if the input is null or empty
        }
    }


    if (!function_exists('format_currency'))
    {
        /**
         * Format a given amount as currency.
         *
         * @param float|int $amount The amount to be formatted.
         * @param string $currency The currency code (e.g., 'USD', 'INR').
         * @param string|null $locale The locale for formatting (e.g., 'en_US', 'en_IN'). Defaults to app locale.
         * @return string Formatted currency string.
         */
        function format_currency($amount, $currency = 'INR', $locale = 'en_US')
        {
            $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
            return $formatter->formatCurrency($amount, $currency);
        }
    }

    if (!function_exists('Get_Site_Setting'))
    {
        /**
         * Format a given amount as currency.
         *
         * @param float|int $amount The amount to be formatted.
         * @param string $currency The currency code (e.g., 'USD', 'INR').
         * @param string|null $locale The locale for formatting (e.g., 'en_US', 'en_IN'). Defaults to app locale.
         * @return string Formatted currency string.
         */
        function Get_Site_Setting()
        {
            return Setting::where('Status',1)->pluck('Value', 'Name')->toArray();
        }
    }

    if (!function_exists('generateStarRating'))
    {
        /**
         * Generate HTML for star rating based on the given rating.
         *
         * @param float $rating The rating value (e.g., 3.5).
         * @param int $maxStars The maximum number of stars (default: 5).
         * @return string The generated HTML for the star rating.
         */
        function generateStarRating(float $rating, int $maxStars = 5): string
        {
            $html = '';
            $fullStars = floor($rating); // Number of full stars
            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0; // Determine if a half star is needed
            $emptyStars = $maxStars - $fullStars - $halfStar; // Remaining stars are empty

            // Add full stars
            for ($i = 0; $i < $fullStars; $i++)
            {
                $html .= '<a href="javascript:void(0);"><i class="fas fa-star"></i></a>';
            }

            // Add half star
            if ($halfStar)
            {
                $html .= '<a href="javascript:void(0);"><i class="fas fa-star-half-alt"></i></a>';
            }

            // Add empty stars
            for ($i = 0; $i < $emptyStars; $i++)
            {
                $html .= '<a href="javascript:void(0);"><i class="far fa-star"></i></a>';
            }

            return $html;
        }
    }

    if (!function_exists('generateStarRatingSlider'))
    {
        /**
         * Generate HTML for star rating based on the given rating.
         *
         * @param float $rating The rating value (e.g., 3.5).
         * @param int $maxStars The maximum number of stars (default: 5).
         * @return string The generated HTML for the star rating.
         */
        function generateStarRatingSlider(float $rating, int $maxStars = 5): string
        {
            $html = '';
            $fullStars = floor($rating); // Number of full stars
            $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0; // Determine if a half star is needed
            $emptyStars = $maxStars - $fullStars - $halfStar; // Remaining stars are empty

            // Add full stars
            for ($i = 0; $i < $fullStars; $i++)
            {
                $html .= '<span><i class="fas fa-star"></i></span>';
                // $html .= '<a href="javascript:void(0);"><i class="fas fa-star"></i></a>';
            }

            // Add half star
            if ($halfStar)
            {
                $html .= '<span><i class="fas fa-star-half-alt"></i></span>';
                // $html .= '<a href="javascript:void(0);"><i class="fas fa-star-half-alt"></i></a>';
            }

            // Add empty stars
            for ($i = 0; $i < $emptyStars; $i++)
            {
                $html .= '<span><i class="far fa-star"></i></span>';
                // $html .= '<a href="javascript:void(0);"><i class="far fa-star"></i></a>';
            }

            return $html;
        }
    }

    if (!function_exists('getInitials'))
    {
        function getInitials($name)
        {
            // return strtoupper(preg_replace('/\b(\w)\w*\b/', '$1', $name));
            return removeSpaces(strtoupper(preg_replace('/\b(\w)\w*\b/', '$1', $name)));
        }
    }

    if (!function_exists('removeSpaces'))
    {
        function removeSpaces($string) {
            return preg_replace('/\s+/', '', $string);
        }
    }

    if (!function_exists('timeAgo'))
    {
    /**
         * Get the time ago for a given datetime.
         *
         * @param string $datetime The datetime string.
         * @return string Human-readable "time ago".
         */
        function timeAgo($datetime)
        {
            return Carbon::parse($datetime)->diffForHumans();
        }
    }

    if (!function_exists('randomTextClass'))
    {
        /**
         * Get a random text class for Bootstrap (text-danger, text-info, text-warning, text-success).
         *
         * @return string The class name.
         */
        function randomTextClass()
        {
            $classes = ['text-danger', 'text-info', 'text-warning', 'text-success'];
            return $classes[array_rand($classes)];
        }
    }

?>