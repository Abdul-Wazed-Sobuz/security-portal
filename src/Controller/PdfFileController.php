<?php

/*
 * This file is part of Secure Portal project.
 *      (c) AWS 2025 - 2025.
 *             All rights reserved.
 */

namespace App\Controller;

use App\Repository\MemberInformationRepository;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PdfFileController extends AbstractController
{
    #[Route('/member-information', name: 'app_user_information')]
    public function index(MemberInformationRepository $repository): Response
    {
        $memberInfo = $repository->getAllMemberInfo();
        return $this->render('pdf_file/index.html.twig', [
            'controller_name' => 'PdfFileController',
            'memberInfo' => $memberInfo,
        ]);
    }

    #[Route('/member-information/download', name: 'user_report_download')]
    public function generateReport(Pdf $knpSnappyPdf, MemberInformationRepository $repository): Response
    {
        $memberInfo = $repository->getAllMemberInfo();
        $currentDate = date('d-M-Y');
        $currentTime = date('h:i A');
        $dateTime = $currentDate . ' ' . $currentTime;
        $html = $this->renderView('pdf_file/download_report.html.twig', [
            'memberInfo' => $memberInfo,
            'current_date_time' => $dateTime,
        ]);
        //        $footerHtml = $this->renderView('pdf_file/footer.html.twig');

        // Save footer HTML into a temporary file
        //        $footerFile = tempnam(sys_get_temp_dir(), 'footer_') . '.html';
        //        file_put_contents($footerFile, $footerHtml);

        $pdfContent = $knpSnappyPdf->getOutputFromHtml($html, [
            'footer-right' => 'Page [page] of [topage]',
            'footer-center' => 'Member Information Report',
            'footer-left' => 'Developed by: awsIT Service Limited',
            'header-left' => 'awsIT Service Limited',
            'footer-font-size' => 9,
            'footer-spacing' => 5,
            'margin-bottom' => 10,
        ]);

        // Clean up temp file
        //        @unlink($footerFile);

        return new Response(
            $pdfContent,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="member_information.pdf"',
            ]
        );
    }
}
