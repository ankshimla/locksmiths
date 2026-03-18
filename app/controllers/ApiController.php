<?php
/**
 * API Controller - Handles AJAX form submissions
 */
class ApiController extends Controller {

    public function quote(array $params = []): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['error' => 'Method not allowed'], 405);
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'service' => trim($_POST['service'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
        ];

        // Validation
        if (empty($data['name']) || empty($data['phone'])) {
            $this->json(['success' => false, 'error' => 'Name and phone are required.'], 400);
        }

        if (!preg_match('/^[0-9+\s()-]{7,20}$/', $data['phone'])) {
            $this->json(['success' => false, 'error' => 'Please enter a valid phone number.'], 400);
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'error' => 'Please enter a valid email address.'], 400);
        }

        // Sanitize
        $data['name'] = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $data['phone'] = htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8');
        $data['email'] = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $data['service'] = htmlspecialchars($data['service'], ENT_QUOTES, 'UTF-8');
        $data['location'] = htmlspecialchars($data['location'], ENT_QUOTES, 'UTF-8');
        $data['message'] = htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8');

        // Honeypot check
        if (!empty($_POST['website'])) {
            $this->json(['success' => true, 'message' => 'Thank you! We will call you shortly.']);
        }

        // Save to database
        $quoteModel = new Quote();
        $quoteModel->insert($data);

        $this->json([
            'success' => true,
            'message' => 'Thank you! We have received your request and will call you within 15 minutes.'
        ]);
    }

    public function contact(array $params = []): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['error' => 'Method not allowed'], 405);
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'service' => 'Contact Form',
            'location' => '',
            'message' => trim($_POST['message'] ?? ''),
        ];

        if (empty($data['name']) || empty($data['message'])) {
            $this->json(['success' => false, 'error' => 'Name and message are required.'], 400);
        }

        $data['name'] = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $data['phone'] = htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8');
        $data['email'] = htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8');
        $data['message'] = htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8');

        if (!empty($_POST['website'])) {
            $this->json(['success' => true, 'message' => 'Thank you for your message!']);
        }

        $quoteModel = new Quote();
        $quoteModel->insert($data);

        $this->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you shortly.'
        ]);
    }
}
