<?php

namespace AppBundle\Entity\Production\Analysis;

use AppBundle\Entity\Storage\Sample;
use Carbon\ApiBundle\Annotation AS Carbon;
use Carbon\ApiBundle\Entity\Production\BaseRequestSampleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation AS JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="production.spr_request_binding_partner", schema="production")
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class SprRequestBindingPartner
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMS\Groups({"default"})
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="request_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $requestId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Production\Analysis\SprRequest")
     * @ORM\JoinColumn(name="request_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $request;

    /**
     * @var integer
     *
     * @ORM\Column(name="ligand_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $ligandId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample")
     * @ORM\JoinColumn(name="ligand_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $ligand;

    /**
     * @var integer
     *
     * @ORM\Column(name="analyte_id", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $analyteId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Storage\Sample")
     * @ORM\JoinColumn(name="analyte_id", nullable=false)
     * @JMS\Groups({"default"})
     */
    protected $analyte;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_binding_sites", type="integer")
     * @JMS\Groups({"default"})
     */
    protected $numBindingSites;

    /**
     * @ORM\Column(name="ligand_mw", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $ligandMw;

    /**
     * @ORM\Column(name="analyte_mw", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $analyteMw;

    /**
     * @ORM\Column(name="concentration", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $analyteConcentration;

    /**
     * @ORM\Column(name="k_on", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $kOn;

    /**
     * @ORM\Column(name="k_off", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $kOff;

    /**
     * @ORM\Column(name="k_d", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $kD;

    /**
     * @ORM\Column(name="r_max_fit", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $rMaxFit;

    /**
     * @ORM\Column(name="r_max_exp", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $rMaxExp;

    /**
     * @ORM\Column(name="r_max_ratio", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $rMaxRatio;

    /**
     * @ORM\Column(name="signal_level", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $signalLevel;

    /**
     * @ORM\Column(name="signal_ratio", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $signalRatio;

    /**
     * @ORM\Column(name="chi2", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $chi2;

    /**
     * @ORM\Column(name="norm_chi2", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $normChi2;

    /**
     * @ORM\Column(name="r_max_equil", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $rMaxEquil;

    /**
     * @ORM\Column(name="k_d_equil", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $kDEquil;

    /**
     * @ORM\Column(name="r_max", type="boolean", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $rMax;

    /**
     * @ORM\Column(name="k_on_in_range", type="boolean", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $kOnInRange;

    /**
     * @ORM\Column(name="k_off_in_range", type="boolean", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $kOffInRange;

    /**
     * @ORM\Column(name="capture", type="string", nullable=true, length=150)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $capture;

    /**
     * @ORM\Column(name="curve_fit", type="string", nullable=true, length=150)
     * @JMS\Groups({"default"})
     * @Gedmo\Versioned
     */
    protected $curveFit;

    /**
     * @ORM\Column(name="equil", type="boolean", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $equil;

    /**
     * @ORM\Column(name="k_d_fix", type="decimal", precision=20, scale=3, nullable=true)
     * @Gedmo\Versioned
     * @JMS\Groups({"default"})
     * @JMS\Type("double")
     */
    protected $kDFix;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @JMS\Groups({"default"})
     */
    protected $deletedAt;

    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of requestId.
     *
     * @return integer
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Sets the value of requestId.
     *
     * @param integer $requestId the request id
     *
     * @return self
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Gets the value of request.
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the value of request.
     *
     * @param mixed $request the request
     *
     * @return self
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Gets the value of ligandId.
     *
     * @return integer
     */
    public function getLigandId()
    {
        return $this->ligandId;
    }

    /**
     * Sets the value of ligandId.
     *
     * @param integer $ligandId the ligand id
     *
     * @return self
     */
    public function setLigandId($ligandId)
    {
        $this->ligandId = $ligandId;

        return $this;
    }

    /**
     * Gets the value of ligand.
     *
     * @return mixed
     */
    public function getLigand()
    {
        return $this->ligand;
    }

    /**
     * Sets the value of ligand.
     *
     * @param mixed $ligand the ligand
     *
     * @return self
     */
    public function setLigand($ligand)
    {
        $this->ligand = $ligand;

        return $this;
    }

    /**
     * Gets the value of analyteId.
     *
     * @return integer
     */
    public function getAnalyteId()
    {
        return $this->analyteId;
    }

    /**
     * Sets the value of analyteId.
     *
     * @param integer $analyteId the analyte id
     *
     * @return self
     */
    public function setAnalyteId($analyteId)
    {
        $this->analyteId = $analyteId;

        return $this;
    }

    /**
     * Gets the value of analyte.
     *
     * @return mixed
     */
    public function getAnalyte()
    {
        return $this->analyte;
    }

    /**
     * Sets the value of analyte.
     *
     * @param mixed $analyte the analyte
     *
     * @return self
     */
    public function setAnalyte($analyte)
    {
        $this->analyte = $analyte;

        return $this;
    }

    /**
     * Gets the value of deletedAt.
     *
     * @return \DateTime $deletedAt
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Sets the value of deletedAt.
     *
     * @param \DateTime $deletedAt $deletedAt the deleted at
     *
     * @return self
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Gets the value of numBindingSites.
     *
     * @return integer
     */
    public function getNumBindingSites()
    {
        return $this->numBindingSites;
    }

    /**
     * Sets the value of numBindingSites.
     *
     * @param integer $numBindingSites the num binding sites
     *
     * @return self
     */
    public function setNumBindingSites($numBindingSites)
    {
        $this->numBindingSites = $numBindingSites;

        return $this;
    }

    /**
     * Gets the value of ligandMw.
     *
     * @return mixed
     */
    public function getLigandMw()
    {
        return $this->ligandMw;
    }

    /**
     * Sets the value of ligandMw.
     *
     * @param mixed $ligandMw the ligand mw
     *
     * @return self
     */
    public function setLigandMw($ligandMw)
    {
        $this->ligandMw = $ligandMw;

        return $this;
    }

    /**
     * Gets the value of analyteMw.
     *
     * @return mixed
     */
    public function getAnalyteMw()
    {
        return $this->analyteMw;
    }

    /**
     * Sets the value of analyteMw.
     *
     * @param mixed $analyteMw the analyte mw
     *
     * @return self
     */
    public function setAnalyteMw($analyteMw)
    {
        $this->analyteMw = $analyteMw;

        return $this;
    }

    /**
     * Gets the value of analyteConcentration.
     *
     * @return mixed
     */
    public function getAnalyteConcentration()
    {
        return $this->analyteConcentration;
    }

    /**
     * Sets the value of analyteConcentration.
     *
     * @param mixed $analyteConcentration the analyte concentration
     *
     * @return self
     */
    public function setAnalyteConcentration($analyteConcentration)
    {
        $this->analyteConcentration = $analyteConcentration;

        return $this;
    }

    /**
     * Gets the value of kOn.
     *
     * @return mixed
     */
    public function getKOn()
    {
        return $this->kOn;
    }

    /**
     * Sets the value of kOn.
     *
     * @param mixed $kOn the k on
     *
     * @return self
     */
    public function setKOn($kOn)
    {
        $this->kOn = $kOn;

        return $this;
    }

    /**
     * Gets the value of kOff.
     *
     * @return mixed
     */
    public function getKOff()
    {
        return $this->kOff;
    }

    /**
     * Sets the value of kOff.
     *
     * @param mixed $kOff the k off
     *
     * @return self
     */
    public function setKOff($kOff)
    {
        $this->kOff = $kOff;

        return $this;
    }

    /**
     * Gets the value of kD.
     *
     * @return mixed
     */
    public function getKD()
    {
        return $this->kD;
    }

    /**
     * Sets the value of kD.
     *
     * @param mixed $kD the k d
     *
     * @return self
     */
    public function setKD($kD)
    {
        $this->kD = $kD;

        return $this;
    }

    /**
     * Gets the value of rMaxFit.
     *
     * @return mixed
     */
    public function getRMaxFit()
    {
        return $this->rMaxFit;
    }

    /**
     * Sets the value of rMaxFit.
     *
     * @param mixed $rMaxFit the r max fit
     *
     * @return self
     */
    public function setRMaxFit($rMaxFit)
    {
        $this->rMaxFit = $rMaxFit;

        return $this;
    }

    /**
     * Gets the value of rMaxExp.
     *
     * @return mixed
     */
    public function getRMaxExp()
    {
        return $this->rMaxExp;
    }

    /**
     * Sets the value of rMaxExp.
     *
     * @param mixed $rMaxExp the r max exp
     *
     * @return self
     */
    public function setRMaxExp($rMaxExp)
    {
        $this->rMaxExp = $rMaxExp;

        return $this;
    }

    /**
     * Gets the value of rMaxRatio.
     *
     * @return mixed
     */
    public function getRMaxRatio()
    {
        return $this->rMaxRatio;
    }

    /**
     * Sets the value of rMaxRatio.
     *
     * @param mixed $rMaxRatio the r max ratio
     *
     * @return self
     */
    public function setRMaxRatio($rMaxRatio)
    {
        $this->rMaxRatio = $rMaxRatio;

        return $this;
    }

    /**
     * Gets the value of signalLevel.
     *
     * @return mixed
     */
    public function getSignalLevel()
    {
        return $this->signalLevel;
    }

    /**
     * Sets the value of signalLevel.
     *
     * @param mixed $signalLevel the signal level
     *
     * @return self
     */
    public function setSignalLevel($signalLevel)
    {
        $this->signalLevel = $signalLevel;

        return $this;
    }

    /**
     * Gets the value of signalRatio.
     *
     * @return mixed
     */
    public function getSignalRatio()
    {
        return $this->signalRatio;
    }

    /**
     * Sets the value of signalRatio.
     *
     * @param mixed $signalRatio the signal ratio
     *
     * @return self
     */
    public function setSignalRatio($signalRatio)
    {
        $this->signalRatio = $signalRatio;

        return $this;
    }

    /**
     * Gets the value of chi2.
     *
     * @return mixed
     */
    public function getChi2()
    {
        return $this->chi2;
    }

    /**
     * Sets the value of chi2.
     *
     * @param mixed $chi2 the chi2
     *
     * @return self
     */
    public function setChi2($chi2)
    {
        $this->chi2 = $chi2;

        return $this;
    }

    /**
     * Gets the value of normChi2.
     *
     * @return mixed
     */
    public function getNormChi2()
    {
        return $this->normChi2;
    }

    /**
     * Sets the value of normChi2.
     *
     * @param mixed $normChi2 the norm chi2
     *
     * @return self
     */
    public function setNormChi2($normChi2)
    {
        $this->normChi2 = $normChi2;

        return $this;
    }

    /**
     * Gets the value of rMaxEquil.
     *
     * @return mixed
     */
    public function getRMaxEquil()
    {
        return $this->rMaxEquil;
    }

    /**
     * Sets the value of rMaxEquil.
     *
     * @param mixed $rMaxEquil the r max equil
     *
     * @return self
     */
    public function setRMaxEquil($rMaxEquil)
    {
        $this->rMaxEquil = $rMaxEquil;

        return $this;
    }

    /**
     * Gets the value of kDEquil.
     *
     * @return mixed
     */
    public function getKDEquil()
    {
        return $this->kDEquil;
    }

    /**
     * Sets the value of kDEquil.
     *
     * @param mixed $kDEquil the k d equil
     *
     * @return self
     */
    public function setKDEquil($kDEquil)
    {
        $this->kDEquil = $kDEquil;

        return $this;
    }

    /**
     * Gets the value of rMax.
     *
     * @return mixed
     */
    public function getRMax()
    {
        return $this->rMax;
    }

    /**
     * Sets the value of rMax.
     *
     * @param mixed $rMax the r max
     *
     * @return self
     */
    public function setRMax($rMax)
    {
        $this->rMax = $rMax;

        return $this;
    }

    /**
     * Gets the value of kOnInRange.
     *
     * @return mixed
     */
    public function getKOnInRange()
    {
        return $this->kOnInRange;
    }

    /**
     * Sets the value of kOnInRange.
     *
     * @param mixed $kOnInRange the k on in range
     *
     * @return self
     */
    public function setKOnInRange($kOnInRange)
    {
        $this->kOnInRange = $kOnInRange;

        return $this;
    }

    /**
     * Gets the value of kOffInRange.
     *
     * @return mixed
     */
    public function getKOffInRange()
    {
        return $this->kOffInRange;
    }

    /**
     * Sets the value of kOffInRange.
     *
     * @param mixed $kOffInRange the k off in range
     *
     * @return self
     */
    public function setKOffInRange($kOffInRange)
    {
        $this->kOffInRange = $kOffInRange;

        return $this;
    }

    /**
     * Gets the value of capture.
     *
     * @return mixed
     */
    public function getCapture()
    {
        return $this->capture;
    }

    /**
     * Sets the value of capture.
     *
     * @param mixed $capture the capture
     *
     * @return self
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;

        return $this;
    }

    /**
     * Gets the value of curveFit.
     *
     * @return mixed
     */
    public function getCurveFit()
    {
        return $this->curveFit;
    }

    /**
     * Sets the value of curveFit.
     *
     * @param mixed $curveFit the curve fit
     *
     * @return self
     */
    public function setCurveFit($curveFit)
    {
        $this->curveFit = $curveFit;

        return $this;
    }

    /**
     * Gets the value of equil.
     *
     * @return mixed
     */
    public function getEquil()
    {
        return $this->equil;
    }

    /**
     * Sets the value of equil.
     *
     * @param mixed $equil the equil
     *
     * @return self
     */
    public function setEquil($equil)
    {
        $this->equil = $equil;

        return $this;
    }

    /**
     * Gets the value of kDFix.
     *
     * @return mixed
     */
    public function getKDFix()
    {
        return $this->kDFix;
    }

    /**
     * Sets the value of kDFix.
     *
     * @param mixed $kDFix the k d fix
     *
     * @return self
     */
    public function setKDFix($kDFix)
    {
        $this->kDFix = $kDFix;

        return $this;
    }
}
