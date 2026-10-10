<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Homepage View
     */
    public function index(): string
    {
        $sectionModel = new \App\Models\HomepageSectionModel();
        $slideModel   = new \App\Models\HomepageSlideModel();
        $serviceModel = new \App\Models\HomepageServiceModel();

        $hero       = $sectionModel->getSection('hero');
        $philosophy = $sectionModel->getSection('philosophy');
        $slides     = $slideModel->getOrderedSlides(true);
        $services   = $serviceModel->getOrderedServices(true);
        $offerModel = new \App\Models\OfferModel();
        $offers     = $offerModel->getActiveFrontendOffers();

        return view('glowup/index', [
            'hero'       => $hero,
            'philosophy' => $philosophy,
            'slides'     => $slides,
            'services'   => $services,
            'offers'     => $offers,
        ]);
    }

    /**
     * Services View
     */
    public function services(): string
    {
        $serviceModel  = new \App\Models\ServiceModel();
        $categoryModel = new \App\Models\CategoryModel();
        $services      = $serviceModel->getFilteredServices(null, null, '1', 100, 0);
        $categories    = $categoryModel->getAllCategories();
        $categoryMap   = $categoryModel->getCategoryMap();
        $offerModel    = new \App\Models\OfferModel();
        $offers        = $offerModel->getActiveFrontendOffers();

        return view('glowup/services', [
            'services'    => $services,
            'categories'  => $categories,
            'categoryMap' => $categoryMap,
            'offers'      => $offers,
        ]);
    }

    /**
     * About Us View
     */
    public function about(): string
    {
        $aboutModel = new \App\Models\AboutModel();
        $teamModel  = new \App\Models\TeamModel();

        $settings = $aboutModel->getSettings();
        $team     = $teamModel->getOrderedMembers(true);

        return view('glowup/about', [
            'settings' => $settings,
            'team'     => $team,
        ]);
    }

    /**
     * Academy View
     */
    public function academy(): string
    {
        $courseModel = new \App\Models\CourseModel();
        $courses = $courseModel->getOrderedCourses(true);

        return view('glowup/academy', [
            'courses' => $courses,
        ]);
    }

    /**
     * Gallery View
     */
    public function gallery(): string
    {
        $galleryModel = new \App\Models\GalleryModel();
        $galleryItems = $galleryModel->getActiveGallery();

        return view('glowup/gallery', [
            'galleryItems' => $galleryItems,
        ]);
    }

    /**
     * Contact View
     */
    public function contact(): string
    {
        $footerModel = new \App\Models\FooterModel();
        $footerData = $footerModel->getFooterData();

        return view('glowup/contact', [
            'settings' => $footerData['settings'] ?? [],
        ]);
    }

    /**
     * Dynamic Review Folio View
     */
    public function review(): string
    {
        $reviewModel = new \App\Models\ReviewModel();
        $reviews = $reviewModel->getPublishedReviews();
        $stats = $reviewModel->getReviewStatistics();

        return view('glowup/review', [
            'reviews' => $reviews,
            'stats'   => $stats,
        ]);
    }

    /**
     * Submit Patron Review via Frontend Form
     */
    public function submitReview()
    {
        $name = trim((string) $this->request->getPost('name'));
        $phone = trim((string) $this->request->getPost('phone'));
        $service = trim((string) $this->request->getPost('service'));
        $specialist = trim((string) $this->request->getPost('specialist'));
        $score = max(1, min(5, (int) $this->request->getPost('score')));
        $headline = trim((string) $this->request->getPost('headline'));
        $experience = trim((string) $this->request->getPost('experience'));

        if (empty($name) || empty($experience)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please provide your full name and review description.',
            ]);
        }

        // Determine category based on service name
        $lowerService = strtolower($service);
        $category = 'all';
        if (strpos($lowerService, 'hair') !== false || strpos($lowerService, 'keratin') !== false || strpos($lowerService, 'smoothing') !== false || strpos($lowerService, 'straightening') !== false || strpos($lowerService, 'botox') !== false) {
            $category = 'hair';
        } elseif (strpos($lowerService, 'facial') !== false || strpos($lowerService, 'gold') !== false || strpos($lowerService, 'hydra') !== false) {
            $category = 'facials';
        } elseif (strpos($lowerService, 'bridal') !== false || strpos($lowerService, 'couture') !== false) {
            $category = 'bridal';
        } elseif (strpos($lowerService, 'academy') !== false || strpos($lowerService, 'diploma') !== false || strpos($lowerService, 'course') !== false) {
            $category = 'academy';
        }

        $reviewModel = new \App\Models\ReviewModel();
        $reviewModel->insert([
            'customer_name'   => $name,
            'customer_photo'  => null,
            'rating'          => $score,
            'headline'        => $headline ?: null,
            'review_text'     => $experience,
            'service_name'    => $service ?: 'Bespoke Experience',
            'category'        => $category,
            'specialist_name' => $specialist ?: null,
            'location'        => 'Madurai',
            'phone'           => $phone ?: null,
            'status'          => 'pending',
            'sort_order'      => 0,
            'is_verified'     => 1,
        ]);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Thank you ' . esc($name) . '! Your review has been submitted for concierge verification and will be published shortly.',
        ]);
    }

    /**
     * Booking View
     */
    public function booking(): string
    {
        $serviceModel = new \App\Models\ServiceModel();
        $services = $serviceModel->getFilteredServices(null, null, '1', 100, 0);

        $auth = new \App\Libraries\CustomerAuth();
        $customer = $auth->user();

        return view('glowup/booking', [
            'services' => $services,
            'customer' => $customer,
        ]);
    }

    /**
     * Check Unavailable Time Slots for a Date & Specialist (AJAX API)
     */
    public function checkSlots()
    {
        $date = trim((string) $this->request->getGet('date'));
        $specialist = trim((string) $this->request->getGet('specialist'));

        if (empty($date)) {
            return $this->response->setJSON([
                'status'            => true,
                'unavailable_slots' => [],
            ]);
        }

        $timestamp = strtotime($date);
        if (!$timestamp) {
            return $this->response->setJSON([
                'status'            => false,
                'message'           => 'Invalid date format.',
                'unavailable_slots' => [],
            ]);
        }

        $formattedDate = date('Y-m-d', $timestamp);
        $bookingModel = new \App\Models\BookingModel();

        $query = $bookingModel->select('time_slot')
            ->where('booking_date', $formattedDate)
            ->whereIn('status', ['pending', 'confirmed', 'in_progress']);

        if (!empty($specialist) && strcasecmp($specialist, 'Any Master Specialist') !== 0) {
            $query->groupStart()
                ->where('specialist', $specialist)
                ->orWhere('specialist', 'Any Master Specialist')
                ->orWhere('specialist IS NULL')
                ->groupEnd();
        }

        $rows = $query->findAll();
        $unavailableSlots = [];
        foreach ($rows as $row) {
            if (!empty($row['time_slot'])) {
                $unavailableSlots[] = trim($row['time_slot']);
            }
        }

        return $this->response->setJSON([
            'status'            => true,
            'date'              => $formattedDate,
            'unavailable_slots' => array_values(array_unique($unavailableSlots)),
        ]);
    }

    /**
     * Patron Profile View
     */
    public function profile()
    {
        $auth = new \App\Libraries\CustomerAuth();
        if (!$auth->isLoggedIn()) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Please sign in to access your patron account and bookings.');
        }

        $user = $auth->user();
        $customerModel = new \App\Models\CustomerModel();
        $offerModel    = new \App\Models\OfferModel();

        $profile = $customerModel->getCompleteCustomerProfile((int) ($user['id'] ?? 0));
        $offers  = $offerModel->getActiveFrontendOffers();

        return view('glowup/profile', [
            'customer' => $user,
            'profile'  => $profile,
            'offers'   => $offers,
        ]);
    }

    /**
     * Submit Contact Form to Database (Enquiries & CRM Leads)
     */
    public function submitContact()
    {
        $name    = trim((string) $this->request->getPost('name'));
        $email   = trim((string) $this->request->getPost('email'));
        $phone   = trim((string) $this->request->getPost('phone'));
        $subject = trim((string) $this->request->getPost('subject'));
        $message = trim((string) $this->request->getPost('message'));

        if (empty($name) || empty($email) || empty($message)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please fill in all required fields (Name, Email, Message).',
            ]);
        }

        // 1. Save in Enquiries
        $enquiryModel = new \App\Models\EnquiryModel();
        $inserted = $enquiryModel->insert([
            'name'        => $name,
            'email'       => $email,
            'phone'       => $phone ?: null,
            'subject'     => $subject ?: 'General Inquiry',
            'message'     => $message,
            'status'      => 'new',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // 2. Automatically capture or link as CRM Lead
        $lowerSubject = strtolower($subject);
        $leadSource = 'Website Enquiry';
        if (strpos($lowerSubject, 'bridal') !== false) {
            $leadSource = 'Bridal Enquiry';
        } elseif (strpos($lowerSubject, 'academy') !== false) {
            $leadSource = 'Academy Enquiry';
        }

        $leadModel = new \App\Models\LeadModel();
        $leadModel->insert([
            'name'               => $name,
            'phone'              => $phone ?: '',
            'whatsapp'           => $phone ?: '',
            'email'              => $email,
            'service_interested' => $subject ?: 'General Consultation',
            'source'             => $leadSource,
            'campaign'           => 'Website Contact Form',
            'notes'              => 'Client Message: ' . substr($message, 0, 300),
            'status'             => 'new',
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s'),
        ]);

        if ($inserted) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Thank you ' . esc($name) . '! Your message has been received by our concierge. We will respond within 2 hours.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => false,
            'message' => 'Failed to save message. Please try again.',
        ]);
    }

    /**
     * Submit Academy Enrollment Form to Database (Enquiries & CRM Leads)
     */
    public function submitAcademyEnroll()
    {
        $name   = trim((string) $this->request->getPost('name'));
        $phone  = trim((string) $this->request->getPost('phone'));
        $email  = trim((string) $this->request->getPost('email'));
        $course = trim((string) $this->request->getPost('course'));
        $batch  = trim((string) $this->request->getPost('batch'));
        $exp    = trim((string) $this->request->getPost('experience'));
        $notes  = trim((string) $this->request->getPost('notes'));

        if (empty($name) || empty($phone) || empty($email) || empty($course)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please provide your full name, phone number, email address, and program of interest.',
            ]);
        }

        // 1. Save in Enquiries
        $enquiryModel = new \App\Models\EnquiryModel();
        $enquiryModel->insert([
            'name'       => $name,
            'email'      => $email,
            'phone'      => $phone,
            'subject'    => 'Academy Admission: ' . $course,
            'message'    => "Program: {$course}\nBatch: {$batch}\nExperience: {$exp}\nAspirations: {$notes}",
            'status'     => 'new',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // 2. Save in CRM Leads
        $leadModel = new \App\Models\LeadModel();
        $leadId = $leadModel->insert([
            'name'               => $name,
            'phone'              => $phone,
            'whatsapp'           => $phone,
            'email'              => $email,
            'service_interested' => $course,
            'source'             => 'Academy Enquiry',
            'campaign'           => 'Academy Enrollment Form',
            'notes'              => "Batch: {$batch} | Experience: {$exp} | Notes: {$notes}",
            'status'             => 'new',
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s'),
        ]);

        // 3. Auto-link or provision customer
        $customerModel = new \App\Models\CustomerModel();
        $existingCust = $customerModel->where('email', $email)->orWhere('phone', $phone)->first();
        if (!$existingCust) {
            $customerModel->insert([
                'name'               => $name,
                'email'              => $email,
                'phone'              => $phone,
                'whatsapp_number'    => $phone,
                'lead_source'        => 'Academy Enrollment',
                'customer_status'    => 'lead',
                'status'             => 1,
                'password'           => password_hash('Patron@123', PASSWORD_DEFAULT),
                'preferred_services' => $course,
                'created_at'         => date('Y-m-d H:i:s'),
            ]);
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Thank you ' . esc($name) . '! Your application for ' . esc($course) . ' has been received. Our Academy Admissions Dean will contact you within 24 hours.',
        ]);
    }

    /**
     * Submit Booking Wizard to Database (Bookings & Customers CRM)
     */
    public function submitBooking()
    {
        $name        = trim((string) $this->request->getPost('name'));
        $email       = trim((string) $this->request->getPost('email'));
        $phone       = trim((string) $this->request->getPost('phone'));
        $serviceId   = (int) $this->request->getPost('service_id');
        $serviceName = trim((string) $this->request->getPost('service'));
        $duration    = trim((string) $this->request->getPost('duration')) ?: '60 Min';
        $specialist  = trim((string) $this->request->getPost('specialist')) ?: 'Any Master Specialist';
        $date        = trim((string) $this->request->getPost('date'));
        $timeSlot    = trim((string) $this->request->getPost('time'));
        $notes       = trim((string) $this->request->getPost('notes'));

        // 1. Validate Customer Contact Information
        if (empty($name) || strlen($name) < 2) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please enter your full name.',
            ]);
        }

        $cleanPhone = preg_replace('/\D+/', '', $phone);
        if (empty($phone) || strlen($cleanPhone) < 7) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please enter a valid mobile or WhatsApp number.',
            ]);
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please provide a valid email address for your confirmation folio.',
            ]);
        }

        // 2. Validate Service from Database
        $serviceModel = new \App\Models\ServiceModel();
        $serviceObj = null;

        if ($serviceId > 0) {
            $serviceObj = $serviceModel->find($serviceId);
        }
        if (!$serviceObj && !empty($serviceName)) {
            $serviceObj = $serviceModel->where('name', $serviceName)->first();
        }

        if (!$serviceObj) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please select a valid service from our sanctuary collection.',
            ]);
        }

        if (isset($serviceObj['is_active']) && (int) $serviceObj['is_active'] !== 1) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'The selected service is currently unavailable. Please choose another ritual.',
            ]);
        }

        // Use authoritative backend details
        $serviceName = $serviceObj['name'];
        $price       = !empty($serviceObj['price']) ? (float) $serviceObj['price'] : 3500.00;
        $duration    = !empty($serviceObj['duration']) ? $serviceObj['duration'] : $duration;

        // 3. Validate Date
        $timestamp = strtotime($date);
        if (empty($date) || !$timestamp) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please select a valid appointment date.',
            ]);
        }

        $formattedDate = date('Y-m-d', $timestamp);
        $today = date('Y-m-d');
        if ($formattedDate < $today) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please select a valid date. Appointments cannot be scheduled in the past.',
            ]);
        }
        $date = $formattedDate;

        // 4. Validate Time Slot
        if (empty($timeSlot)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please choose a preferred time slot.',
            ]);
        }

        // 5. Check Duplicate / Slot Conflict Rules
        $bookingModel = new \App\Models\BookingModel();
        $isAnySpecialist = empty($specialist) || strcasecmp($specialist, 'Any Master Specialist') === 0;

        $conflictQuery = $bookingModel->where('booking_date', $date)
            ->where('time_slot', $timeSlot)
            ->whereIn('status', ['pending', 'confirmed', 'in_progress']);

        if (!$isAnySpecialist) {
            $conflictQuery->groupStart()
                ->where('specialist', $specialist)
                ->orWhere('specialist', 'Any Master Specialist')
                ->orWhere('specialist IS NULL')
                ->groupEnd();
        }

        if ($conflictQuery->first()) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'This time slot is no longer available. Please choose another time.',
            ]);
        }

        // 6. Customer Identification & Authorization
        $auth = new \App\Libraries\CustomerAuth();
        $customerModel = new \App\Models\CustomerModel();
        $customerId = null;

        if ($auth->isLoggedIn()) {
            $customerId = (int) $auth->id();
            $loggedCustomer = $auth->user();
            if (empty($email) && !empty($loggedCustomer['email'])) {
                $email = $loggedCustomer['email'];
            }
        } else {
            $existingCust = null;
            if (!empty($email)) {
                $existingCust = $customerModel->findByEmail($email);
            }
            if (!$existingCust && !empty($phone)) {
                $existingCust = $customerModel->findByIdentifier($phone);
            }

            if ($existingCust) {
                $customerId = (int) $existingCust['id'];
            } else {
                // Auto-provision customer profile for guest booking
                $customerId = $customerModel->insert([
                    'name'               => $name,
                    'email'              => !empty($email) ? $email : ('patron_' . time() . '@glowup.in'),
                    'phone'              => $phone,
                    'whatsapp_number'    => $phone,
                    'lead_source'        => 'Online Booking',
                    'customer_status'    => 'active',
                    'status'             => 1,
                    'password'           => password_hash('Patron@123', PASSWORD_DEFAULT),
                    'preferred_services' => $serviceName,
                    'created_at'         => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // 7. Atomic DB Transaction to Prevent Concurrent Race Conditions
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Re-verify availability inside transaction
            $finalConflictCheck = $bookingModel->where('booking_date', $date)
                ->where('time_slot', $timeSlot)
                ->whereIn('status', ['pending', 'confirmed', 'in_progress']);

            if (!$isAnySpecialist) {
                $finalConflictCheck->groupStart()
                    ->where('specialist', $specialist)
                    ->orWhere('specialist', 'Any Master Specialist')
                    ->orWhere('specialist IS NULL')
                    ->groupEnd();
            }

            if ($finalConflictCheck->first()) {
                $db->transRollback();
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'This time slot was just booked by another patron. Please select another slot.',
                ]);
            }

            // Track CRM Lead Record
            $leadSource = (stripos($serviceName, 'bridal') !== false) ? 'Bridal Booking' : 'Booking Form';
            $leadModel = new \App\Models\LeadModel();
            $leadModel->insert([
                'name'               => $name,
                'phone'              => $phone,
                'whatsapp'           => $phone,
                'email'              => $email ?: '',
                'service_interested' => $serviceName,
                'source'             => $leadSource,
                'campaign'           => 'Website Booking Wizard',
                'notes'              => "Appointment: {$date} at {$timeSlot} with {$specialist}. Notes: {$notes}",
                'status'             => 'booking_confirmed',
                'customer_id'        => $customerId,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);

            // Insert Appointment Record
            $bookingCode = 'GLOW-' . strtoupper(substr(uniqid(), -6));

            $inserted = $bookingModel->insert([
                'booking_code'     => $bookingCode,
                'customer_id'      => $customerId,
                'customer_name'    => $name,
                'customer_email'   => $email ?: 'client@glowup.in',
                'customer_phone'   => $phone,
                'service_name'     => $serviceName,
                'service_price'    => $price,
                'service_duration' => $duration,
                'specialist'       => $specialist,
                'booking_date'     => $date,
                'time_slot'        => $timeSlot,
                'notes'            => $notes ?: null,
                'status'           => 'pending',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);

            if ($inserted && $db->transStatus() !== false) {
                $db->transCommit();
                return $this->response->setJSON([
                    'status'       => true,
                    'booking_code' => $bookingCode,
                    'service_name' => $serviceName,
                    'date'         => $date,
                    'time'         => $timeSlot,
                    'message'      => 'Booking confirmed! Your reference is ' . $bookingCode . '.',
                ]);
            }

            $db->transRollback();
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Unable to complete your booking right now. Please try again.',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Booking transaction failure: ' . $e->getMessage());
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'An unexpected error occurred while confirming your booking. Please try again.',
            ]);
        }
    }
}
