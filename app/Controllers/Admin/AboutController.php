<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;
use App\Models\AboutModel;
use App\Models\TeamModel;

class AboutController extends BaseController
{
    protected AdminAuth $auth;
    protected AboutModel $aboutModel;
    protected TeamModel $teamModel;

    public function __construct()
    {
        $this->auth = new AdminAuth();
        $this->aboutModel = new AboutModel();
        $this->teamModel = new TeamModel();

        // Ensure upload directory exists
        $uploadPath = FCPATH . 'uploads/about';
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0777, true);
        }
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Alex Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'AV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /**
     * About Us CMS page
     */
    public function index()
    {
        $settings = $this->aboutModel->getSettings();
        $team = $this->teamModel->getOrderedMembers();

        return view('admin/pages/website_aboutus', [
            'pageTitle'         => 'About Us CMS | Glowup Admin',
            'pageHeading'       => 'About Us Content Management',
            'pageIcon'          => 'info',
            'breadcrumbSection' => 'Website Content',
            'breadcrumbTitle'   => 'About Us',
            'activeMenu'        => 'website_aboutus',
            'admin'             => $this->getAdminData(),
            'settings'          => $settings,
            'team'              => $team,
        ]);
    }

    /**
     * Update Story and Genesis Narrative
     */
    public function updateContent()
    {
        $rules = [
            'hero_title'    => 'required|min_length[3]|max_length[255]',
            'genesis_title' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $image = $this->request->getPost('genesis_image');
        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/about', $newName);
            $image = 'uploads/about/' . $newName;
        }

        $payload = [
            'hero_title'      => trim((string) $this->request->getPost('hero_title')),
            'hero_subtitle'   => trim((string) $this->request->getPost('hero_subtitle')),
            'genesis_eyebrow' => trim((string) $this->request->getPost('genesis_eyebrow')),
            'genesis_title'   => trim((string) $this->request->getPost('genesis_title')),
            'genesis_copy1'   => trim((string) $this->request->getPost('genesis_copy1')),
            'genesis_copy2'   => trim((string) $this->request->getPost('genesis_copy2')),
            'stat1_value'     => trim((string) $this->request->getPost('stat1_value')),
            'stat1_label'     => trim((string) $this->request->getPost('stat1_label')),
            'stat2_value'     => trim((string) $this->request->getPost('stat2_value')),
            'stat2_label'     => trim((string) $this->request->getPost('stat2_label')),
            'stat3_value'     => trim((string) $this->request->getPost('stat3_value')),
            'stat3_label'     => trim((string) $this->request->getPost('stat3_label')),
        ];

        if (!empty($image)) {
            $payload['genesis_image'] = $image;
        }

        $this->aboutModel->updateSettings($payload);

        return redirect()->to(base_url('admin/website/aboutus#story-tab'))->with('success', 'About Us brand story updated successfully!');
    }

    /**
     * Create or edit a team member
     */
    public function saveMember()
    {
        $id = $this->request->getPost('id');

        $rules = [
            'name' => 'required|min_length[2]|max_length[150]',
            'role' => 'required|min_length[2]|max_length[150]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $imageUrl = $this->request->getPost('image_url');
        $imgFile  = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/about', $newName);
            $imageUrl = 'uploads/about/' . $newName;
        }

        $data = [
            'name'       => trim((string) $this->request->getPost('name')),
            'role'       => trim((string) $this->request->getPost('role')),
            'bio'        => trim((string) $this->request->getPost('bio')),
            'badge'      => trim((string) $this->request->getPost('badge')),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?? 0),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (!empty($imageUrl)) {
            $data['image_url'] = $imageUrl;
        }

        if (!empty($id)) {
            $this->teamModel->update($id, $data);
            $msg = 'Master practitioner profile updated!';
        } else {
            $this->teamModel->insert($data);
            $msg = 'New practitioner added to faculty!';
        }

        return redirect()->to(base_url('admin/website/aboutus#team-tab'))->with('success', $msg);
    }

    /**
     * Delete team member
     */
    public function deleteMember($id)
    {
        $member = $this->teamModel->find($id);
        if ($member) {
            $this->teamModel->delete($id);
            return redirect()->to(base_url('admin/website/aboutus#team-tab'))->with('success', 'Practitioner removed.');
        }
        return redirect()->to(base_url('admin/website/aboutus#team-tab'))->with('error', 'Practitioner not found.');
    }

    /**
     * Toggle Member Active Status
     */
    public function toggleMember($id)
    {
        $member = $this->teamModel->find($id);
        if ($member) {
            $newStatus = $member['is_active'] ? 0 : 1;
            $this->teamModel->update($id, ['is_active' => $newStatus]);
            return redirect()->to(base_url('admin/website/aboutus#team-tab'))->with('success', 'Practitioner active status updated.');
        }
        return redirect()->to(base_url('admin/website/aboutus#team-tab'))->with('error', 'Practitioner record not found.');
    }
}
