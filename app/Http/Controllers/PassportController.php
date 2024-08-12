<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;

class PassportController extends Controller
{
    public function uploadFile(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Get the uploaded file path
        $image = $request->file('image');
        $path = $image->getRealPath();

        // Run OCR on the image
        $tesseract = new TesseractOCR($path);
        $extractedText = $tesseract->run();

        // Extract information from the extracted text
        $first_name = $this->extractFirstName($extractedText);
        $last_name = $this->extractLastName($extractedText);
        $email = $this->extractEmail($extractedText);
        $phone = $this->extractPhone($extractedText);
        $address = $this->extractAddress($extractedText);
        $passport_number = $this->extractPassportNumber($extractedText);
        $nid_number = $this->extractNidNumber($extractedText);
        $gender = $this->extractGender($extractedText);
        $date_of_birth = $this->extractDateOfBirth($extractedText);
        $height = $this->extractHeight($extractedText);
        $weight = $this->extractWeight($extractedText);
        $tax_id_number = $this->extractTaxIdNumber($extractedText);
        $religion = $this->extractReligion($extractedText);

        // Create and save the Passport record
        $passport = new Passport();
        $passport->first_name = $first_name;
        $passport->last_name = $last_name;
        $passport->email = $email;
        $passport->phone = $phone;
        $passport->address = $address;
        $passport->passport_number = $passport_number;
        $passport->nid_number = $nid_number;
        $passport->gender = $gender;
        $passport->date_of_birth = $date_of_birth;
        $passport->height = $height;
        $passport->weight = $weight;
        $passport->tax_id_number = $tax_id_number;
        $passport->religion = $religion;
        $passport->save();

        return redirect()->back()->with('success', 'Information stored successfully!');
    }

    private function extractFirstName($text)
    {
        // Extract first name using regex or string parsing
        preg_match('/First Name:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractLastName($text)
    {
        preg_match('/Last Name:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractEmail($text)
    {
        // Clean the text to minimize OCR errors
        $cleanedText = strip_tags($text);
        $cleanedText = trim($cleanedText);

        // Replace common OCR mistakes
        $cleanedText = str_replace(['gm:', ' gm:'], 'gmail.com', $cleanedText);

        // Use a more flexible regex to capture email addresses
        preg_match('/Email:\s*([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+(?:\.[a-zA-Z]{2,})?)/i', $cleanedText, $matches);

        // Debug: Output the matches to verify the pattern

        return $matches[1] ?? null;
    }

    private function extractPhone($text)
    {
        preg_match('/Phone:\s*([\d]+)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractAddress($text)
    {
        preg_match('/Address:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractPassportNumber($text)
    {
        preg_match('/Passport Number:\s*([\d]+)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractNidNumber($text)
    {
        preg_match('/NID Number:\s*([\d]+)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractGender($text)
    {
        preg_match('/Gender:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractDateOfBirth($text)
    {
        preg_match('/Date Of Birth:\s*(\d{2}\/\d{2}\/\d{4})/i', $text, $matches);
        return isset($matches[1]) ? date('Y-m-d', strtotime($matches[1])) : null;
    }

    private function extractHeight($text)
    {
        preg_match('/Height:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractWeight($text)
    {
        preg_match('/Weight:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractTaxIdNumber($text)
    {
        preg_match('/Tax ID Number:\s*([\d]+)/i', $text, $matches);
        return $matches[1] ?? null;
    }

    private function extractReligion($text)
    {
        preg_match('/Religion:\s*(.*)/i', $text, $matches);
        return $matches[1] ?? null;
    }
}
