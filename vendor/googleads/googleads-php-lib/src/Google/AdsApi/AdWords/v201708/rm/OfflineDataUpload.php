<?php

namespace Google\AdsApi\AdWords\v201708\rm;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class OfflineDataUpload
{

    /**
     * @var int $uploadId
     */
    protected $uploadId = null;

    /**
     * @var int $externalUploadId
     */
    protected $externalUploadId = null;

    /**
     * @var string $uploadType
     */
    protected $uploadType = null;

    /**
     * @var string $uploadStatus
     */
    protected $uploadStatus = null;

    /**
     * @var \Google\AdsApi\AdWords\v201708\rm\UploadMetadata $uploadMetadata
     */
    protected $uploadMetadata = null;

    /**
     * @var \Google\AdsApi\AdWords\v201708\rm\OfflineData[] $offlineDataList
     */
    protected $offlineDataList = null;

    /**
     * @var \Google\AdsApi\AdWords\v201708\cm\ApiError[] $partialDataErrors
     */
    protected $partialDataErrors = null;

    /**
     * @var string $failureReason
     */
    protected $failureReason = null;

    /**
     * @param int $uploadId
     * @param int $externalUploadId
     * @param string $uploadType
     * @param string $uploadStatus
     * @param \Google\AdsApi\AdWords\v201708\rm\UploadMetadata $uploadMetadata
     * @param \Google\AdsApi\AdWords\v201708\rm\OfflineData[] $offlineDataList
     * @param \Google\AdsApi\AdWords\v201708\cm\ApiError[] $partialDataErrors
     * @param string $failureReason
     */
    public function __construct($uploadId = null, $externalUploadId = null, $uploadType = null, $uploadStatus = null, $uploadMetadata = null, array $offlineDataList = null, array $partialDataErrors = null, $failureReason = null)
    {
      $this->uploadId = $uploadId;
      $this->externalUploadId = $externalUploadId;
      $this->uploadType = $uploadType;
      $this->uploadStatus = $uploadStatus;
      $this->uploadMetadata = $uploadMetadata;
      $this->offlineDataList = $offlineDataList;
      $this->partialDataErrors = $partialDataErrors;
      $this->failureReason = $failureReason;
    }

    /**
     * @return int
     */
    public function getUploadId()
    {
      return $this->uploadId;
    }

    /**
     * @param int $uploadId
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setUploadId($uploadId)
    {
      $this->uploadId = (!is_null($uploadId) && PHP_INT_SIZE === 4)
          ? floatval($uploadId) : $uploadId;
      return $this;
    }

    /**
     * @return int
     */
    public function getExternalUploadId()
    {
      return $this->externalUploadId;
    }

    /**
     * @param int $externalUploadId
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setExternalUploadId($externalUploadId)
    {
      $this->externalUploadId = (!is_null($externalUploadId) && PHP_INT_SIZE === 4)
          ? floatval($externalUploadId) : $externalUploadId;
      return $this;
    }

    /**
     * @return string
     */
    public function getUploadType()
    {
      return $this->uploadType;
    }

    /**
     * @param string $uploadType
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setUploadType($uploadType)
    {
      $this->uploadType = $uploadType;
      return $this;
    }

    /**
     * @return string
     */
    public function getUploadStatus()
    {
      return $this->uploadStatus;
    }

    /**
     * @param string $uploadStatus
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setUploadStatus($uploadStatus)
    {
      $this->uploadStatus = $uploadStatus;
      return $this;
    }

    /**
     * @return \Google\AdsApi\AdWords\v201708\rm\UploadMetadata
     */
    public function getUploadMetadata()
    {
      return $this->uploadMetadata;
    }

    /**
     * @param \Google\AdsApi\AdWords\v201708\rm\UploadMetadata $uploadMetadata
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setUploadMetadata($uploadMetadata)
    {
      $this->uploadMetadata = $uploadMetadata;
      return $this;
    }

    /**
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineData[]
     */
    public function getOfflineDataList()
    {
      return $this->offlineDataList;
    }

    /**
     * @param \Google\AdsApi\AdWords\v201708\rm\OfflineData[] $offlineDataList
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setOfflineDataList(array $offlineDataList)
    {
      $this->offlineDataList = $offlineDataList;
      return $this;
    }

    /**
     * @return \Google\AdsApi\AdWords\v201708\cm\ApiError[]
     */
    public function getPartialDataErrors()
    {
      return $this->partialDataErrors;
    }

    /**
     * @param \Google\AdsApi\AdWords\v201708\cm\ApiError[] $partialDataErrors
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setPartialDataErrors(array $partialDataErrors)
    {
      $this->partialDataErrors = $partialDataErrors;
      return $this;
    }

    /**
     * @return string
     */
    public function getFailureReason()
    {
      return $this->failureReason;
    }

    /**
     * @param string $failureReason
     * @return \Google\AdsApi\AdWords\v201708\rm\OfflineDataUpload
     */
    public function setFailureReason($failureReason)
    {
      $this->failureReason = $failureReason;
      return $this;
    }

}
